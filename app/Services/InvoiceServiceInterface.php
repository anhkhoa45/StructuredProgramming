<?php
/**
 * Created by PhpStorm.
 * User: hung
 * Date: 01/12/2018
 * Time: 10:14
 */

namespace App\Services;


use Illuminate\Http\Request;

/**
 * Interface ProductServiceInterface
 * @package App\Services\Interfaces
 */
interface InvoiceServiceInterface extends ServiceInterface
{
    /**
     * Count total invoice
     * @return total invoice num
     */
    function count();

    /**
     * Count total ordered invoice by month (from Jan -> Dec)
     * @return Invoice
     */
    function getMonthlyOrderedInvoiceNum();

    /**
     * Count total paid invoice by month (from Jan -> Dec)
     * @return Invoice
     */
    function getMonthlyPaidInvoiceNum();

    /**
     * Return a number of lastest invoices
     * @param $num number of invoices want to get
     * @return Invoice
     */
    function getLatestInvoices($num);

    /**
     * Monthly revenue from January to December
     * @return Invoice
     */
    function getMonthlyRevenue();
}
