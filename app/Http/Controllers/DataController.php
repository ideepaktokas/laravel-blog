<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         *  composer require laravel/ui
            php artisan ui bootstrap
            php artisan ui:controllers
            npm install
            npm run dev
            npm install resolve-url-loader@^5.0.0 --save-dev --legacy-peer-deps
            npm run dev
         */
        

        /**
         * Enabling asset versions/
         * - Go to webpack.mix.js and add mix.version()
         */

         /**
          * Testing
          * - we have Arrange, Act, Assert
          * - to run test : ./vendor/bin/phpunit
          * - php artisan config:clear  --> This help to clear any cache config
          * - php artisan make:test HomeTest
          * - sudo apt-get install php7.0-sqlite
          * - don't forget to user trait in testCase file after class name ||  use RefreshDatabase;
          */
    }   
}
