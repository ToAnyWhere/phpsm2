<?php
//

namespace Mdanter\Ecc\SM2;
use Mdanter\Ecc\SM3\SM3Digest;
use Mdanter\Ecc\SM2\Hex2ByteBuf;
use Mdanter\Ecc\EccFactory;


class Cipher
{
    private $ct = 1;
    
    private  $p2;
    private  $sm3keybase;
    private  $sm3c3;
    
    private  $key = array();
    private  $keyOff = 0;
    
  
    private function  Reset()//注意，加密使用无符号的数组转换，以便与硬件相一致
    {
        $this->sm3keybase = new SM3Digest();
        $this->sm3c3 = new SM3Digest();
        
        $p=array();

        $gmp_x = $this->p2->GetX();
        $x=Hex2ByteBuf::ConvertGmp2ByteArray($gmp_x);
        $this->sm3keybase->BlockUpdate($x, 0, sizeof($x));
        $this->sm3c3->BlockUpdate($x, 0, sizeof($x));

        $gmp_y = $this->p2->GetY();
        $y=Hex2ByteBuf::ConvertGmp2ByteArray($gmp_y);
        $this->sm3keybase->BlockUpdate($y, 0, sizeof($y));
        
        $ct = 1;
        $this->NextKey();
    }
    
    private function  NextKey()
    {
        $sm3keycur = new SM3Digest();
        $sm3keycur->setSM3Digest($this->sm3keybase);
        $sm3keycur->Update( ($this->ct >> 24 & 0x00ff));
        $sm3keycur->Update( ($this->ct >> 16 & 0x00ff));
        $sm3keycur->Update( ($this->ct >> 8 & 0x00ff));
        $sm3keycur->Update( ($this->ct & 0x00ff));
        $sm3keycur->DoFinal($this->key, 0);
        $this->keyOff = 0;
        $this->ct++;
    }
    
    public function Init_enc($userKey)// 这里要使用随机数，以后补充
    {
      
        $adapter = EccFactory::getAdapter();
        $generator = EccFactory::getNistCurves()->generator256();
        
        这里要使用随机数，以后补充
        //$private = $generator->createPrivateKey();
        //$private = $generator->getPrivateKeyFrom($PriKey_gmp);
        //$k =$private->getSecret();
         $HexPriKey="61FF5386A940D323440CC29F53CE5D23CFE1EF7F18FC066C1BE6E38797B43A30";
        $k = gmp_init($HexPriKey, 16);
        
 
        //$c1=$private->getPoint();
        $PubKeyX="2F7EC5904B370FB9E613EEE46BF157C36078ED2423DB97B7DFD30C8319543E0D";
        $PubKeyY="E417B5B4531485742DF267C1689A63E7A5793CE32BD5345F4E9C227DFFBAD654";
        $Kx = gmp_init($PubKeyX, 16);
        $Ky = gmp_init($PubKeyY, 16);
        $c1 = $generator->getPublicKeyFrom($Kx,$Ky,null);
      
        
        $this->p2 = $userKey->getPoint()->mul($k);
        $this->Reset();
        
        return $c1;
    }
    
    public function  Encrypt($data,$len)
    {
        $this->sm3c3->BlockUpdate($data, 0, $len);
        for ($i = 0; $i <$len; $i++)
        {
            if ($this->keyOff == sizeof($this->key))
                $this->NextKey();
            
                $data[$i] ^= $this->key[$this->keyOff++];
        }
        return $data;
    }
    
    public function Init_dec($userD, $c1)
    {
        $this->p2 = $c1->mul($userD);
        $this->Reset();
    }
    
    public function Decrypt($data,$len)
    {
        for ($i = 0; $i < $len; $i++)
        {
            if ($this->keyOff == sizeof($this->key))
                $this->NextKey();
            
            $data[i] ^= $this->key[$this->keyOff++];
        }
        $this->sm3c3->BlockUpdate($data, 0, $len);
        return $data;
    }
    
    public function  Dofinal()
    {
        $c3=array();
        $gmp_p = $this->p2->GetY();
        $p=Hex2ByteBuf::ConvertGmp2ByteArray($gmp_p);
        $this->sm3c3->BlockUpdate($p, 0, sizeof($p));
        $this->sm3c3->DoFinal($c3, 0);
        //$this->Reset();
        return $c3;
    }
}