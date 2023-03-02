<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FunctionController extends Controller
{

    public function SoalNo6()
    {
        $a = 5;
        $b = 3;

        [$a, $b] = $this->swapVariables($a, $b);
        echo "A = " . $a . ", B = " . $b;
    }

    public function SoalNo7()
    {
        $angka      = 1000300123;
        $var  = $this->var($angka);
        
        echo $var;
    }

    public function swapVariables($a, $b)
    {
        $a = $a + $b;
        $b = $a - $b;
        $a = $a - $b;

        return [$a, $b];
    }

    function var($angka)
    {
        $angka      = floatval($angka);
        $bilangan   = array(
            '',
            'Satu',
            'Dua',
            'Tiga',
            'Empat',
            'Lima',
            'Enam',
            'Tujuh',
            'Delapan',
            'Sembilan',
            'Sepuluh',
            'Sebelas'
        );
        if ($angka < 12) {
            return $bilangan[$angka];
        } elseif ($angka < 20) {
            return $bilangan[$angka - 10] . ' Belas';
        } elseif ($angka < 100) {
            return $bilangan[floor($angka / 10)] . ' Puluh ' . $bilangan[$angka % 10];
        } elseif ($angka < 200) {
            return 'Seratus ' . $this->var($angka % 100);
        } elseif ($angka < 1000) {
            return $bilangan[floor($angka / 100)] . ' Ratus ' . $this->var($angka % 100);
        } elseif ($angka < 2000) {
            return 'Seribu ' . $this->var($angka % 1000);
        } elseif ($angka < 1000000) {
            return $this->var(floor($angka / 1000)) . ' Ribu ' . $this->var($angka % 1000);
        } elseif ($angka < 1000000000) {
            return $this->var(floor($angka / 1000000)) . ' Juta ' . $this->var($angka % 1000000);
        } elseif ($angka < 1000000000000) {
            return $this->var(floor($angka / 1000000000)) . ' Milyar ' . $this->var(fmod($angka, 1000000000));
        } else {
            return 'Angka terlalu besar';
        }
    }
}
