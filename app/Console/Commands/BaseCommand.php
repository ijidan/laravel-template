<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BaseCommand extends Command
{
    /**
     * @var string
     */
    protected $name='base command';

    /**
     * 构造函数
     */
   public function __construct() {
       parent::__construct();
   }
}
