<?php

namespace App\Enum;

enum TransactionType: string 
{
    case Checking = 'CHECKING';
    case Savings = 'SAVINGS';
    case Giving = 'GIVING';
}