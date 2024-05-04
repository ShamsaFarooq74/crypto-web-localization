<?php

namespace Database\Seeders;
use App\Models\Plan;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'nameEN' => 'Test Plan One',
            'nameAR' => 'اختبار الخطة الأولى',
            'price' => 200  ,
            'daily_transfer_amount' => 200,
            'duration' => 60 ,
            'currency' => 'UDTC',
            'descriptionEN' => 'Test is very good and reliable method' ,
            'descriptionAR' => 'لاختبار هو طريقة جيدة جدا وموثوقة',
        ]);
        
        Plan::create([
            'nameEN' => 'Test Plan Two',
            'nameAR' => 'اختبار الخطة الثانية',
            'price' => 300  ,
            'daily_transfer_amount' => 300,
            'duration' => 80 ,
            'currency' => 'UDTC',
            'descriptionEN' => 'Test is very good and reliable method' ,
            'descriptionAR' => 'لاختبار هو طريقة جيدة جدا وموثوقة',
        ]);
        Plan::create([
            'nameEN' => 'Test Plan Three',
            'nameAR' => 'خطة الاختبار الثالثة',
            'price' => 400  ,
            'daily_transfer_amount' => 400,
            'duration' => 120 ,
            'currency' => 'UDTC',
            'descriptionEN' => 'Test is very good and reliable method' ,
            'descriptionAR' => 'لاختبار هو طريقة جيدة جدا وموثوقة',
        ]);

        Plan::create([
            'nameEN' => 'Test Plan Four',
            'nameAR' => 'اختبار الخطة الرابعة',
            'price' => 500  ,
            'daily_transfer_amount' => 400,
            'duration' => 140 ,
            'currency' => 'UDTC',
            'descriptionEN' => 'Test is very good and reliable method' ,
            'descriptionAR' => 'لاختبار هو طريقة جيدة جدا وموثوقة',
        ]);
        Plan::create([
            'nameEN' => 'Test Plan Five',
            'nameAR' => 'اختبار الخطة الخامسة',
            'price' => 600  ,
            'daily_transfer_amount' => 600,
            'duration' => 160 ,
            'currency' => 'UDTC',
            'descriptionEN' => 'Test is very good and reliable method' ,
            'descriptionAR' => 'لاختبار هو طريقة جيدة جدا وموثوقة',
        ]);
    }
}
