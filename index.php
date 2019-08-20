<?php
require_once 'site/private/initialize.php';
// include vs require
/**
 * include does not stop execution
 * require stop execution and show error screen
 */
//require_once vs include_once
/**
 * include or require script just once
 */
header('Location: site/');
/**
 * Simple finance solution for each user
 * Front end website
 * Management of Chart of accounts
 * -Utilities Expense, 12,000 (Parent account) Account type = Assets, Liabilities, Revenue, Expense, Capital 
 * --Electricity bill,4000 (Child account) Expense
 * --Gas Bill,4000 (child Account)
 * --Water Bill,4000 (child account)
 * Management of Opening Balances
 * Management Of Vouchers
 * --Sep electricity bill 3000 -> Expense INC -> Asset -> Cash, Bank Account, DEC
 * -- INC Debit, DEC Credit Electricity Bill = Debit, Cash = Credit
 * Ledger Report
 * -- Electiry Bill
 * Account Name | Desc | DATE | Debit | Credit | Balance
 * Electricity Bill | For the month of Aug | 20 aug, 2019 | 3000 | 0 | 3000
 * Electricity Bill | For the month of Sep | 20 aug, 2019 | 4000 | 0 | 7000
 * Electricity Bill | Mistake | 20 aug 2019 | 0 | 1000 | 6000
 *  */