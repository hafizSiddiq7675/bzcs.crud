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
if(isset($_SESSION['user_id']))
{
    header('Location: site/');
}
else
{
    session_destroy();
    header('Location: front-end/');
}
/**
 * Simple finance solution for each user
 * Front end website
 * Management of Chart of accounts
 * -(id,user_id,coa_name,coa_desc,coa_type,is_parent,parent_id)
 * textbox => coa_name,coa_desc dropdown => type, parent
 * -Utilities Expense, 12,000 (Parent account) Account type = Assets, Liabilities, Revenue, Expense, Capital 
 * --Electricity bill,4000 (Child account) Expense
 * --Gas Bill,4000 (child Account)
 * --Water Bill,4000 (child account)
 * Management of Opening Balance
 * -id{pk},coa_id{FK},ob_debit [decimal],ob_credit[decimal],ob_desc[varchar] (Nullable)
 * --dropdown [all chart of accounts based on user, and user can write opening balance only once for an account]
 * ,textbox for debit, texbox for credit, textbox for desc
 * Electricity expense 10,000 DR, 10,000CR
 * --textbox for amount, textbox for desc, radio buttons for debit and credit
 * --textbox for amount, texbox for desc two submit buttons for credit and debit
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