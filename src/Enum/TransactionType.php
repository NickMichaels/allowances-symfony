<?php

namespace App\Enum;

enum TransactionType: string 
{
    case Withdrawal = 'WITHDRAWAL';
    case Deposit = 'DEPOSIT';
}