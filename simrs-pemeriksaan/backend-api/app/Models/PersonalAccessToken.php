<?php

   namespace App\Models;

   use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

   class PersonalAccessToken extends SanctumPersonalAccessToken
   {
       // Pakai koneksi database simrs (DB1)
       protected $connection = 'simrs';
   }