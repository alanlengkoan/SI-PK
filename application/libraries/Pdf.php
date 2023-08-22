<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * CodeIgniter Dompdf Library
 *
 * Generate PDF's from HTML in CodeIgniter
 *
 * @packge     CodeIgniter
 * @subpackage Libraries
 * @category   Libraries
 * @author     Alan Saputra Lengkoan
 * @license    MIT License
 */

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf extends Dompdf
{
    private $ci;

    public function __construct()
    {
        parent::__construct();
        $this->ci = &get_instance();
    }

    // untuk cetak pdf
    public function cetakPdf($file_name, $view, $data = [])
    {
        $options = new Options();
        $options->setChroot(FCPATH);

        $this->setOptions($options);

        $html = $this->ci->load->view($view, $data, TRUE);
        $this->loadHtml($html);
        $this->render();
        $this->stream($file_name . '.pdf', ['Attachment' => false]);
    }
}
