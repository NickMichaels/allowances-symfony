<?php

namespace App\Enum;

enum AccountType: string 
{
    case Checking = 'CHECKING';
    case Savings = 'SAVINGS';
    case Giving = 'GIVING';
}