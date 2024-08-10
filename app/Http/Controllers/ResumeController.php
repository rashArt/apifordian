<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Company;
use App\Document;
use App\DocumentPayroll;
use Illuminate\Support\Facades\DB;

class ResumeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index()
    {
    }

    public function information_totals($nit, $desde = NULL, $hasta = NULL)
    {
        if($desde && !$hasta)
          $hasta = $desde;
        else
          if(!$desde && $hasta)
            $desde = $hasta;
          else
            if(!$desde && !$hasta)
            {
                $desde = '1900-01-01';
                $hasta = '2100-01-01';
            }

        $company = Company::where('identification_number', $nit)->first();

        if(!$company)
        {
            return [
                'success' => false,
                'message' => 'No se encontraron datos del NIT',
            ];
        }

        $i = Document::where('state_document_id', 1)->where('identification_number', $company->identification_number)->where('type_document_id', 1)->whereDate('date_issue', '>=', $desde)->whereDate('date_issue', '<=', $hasta)->get();
        $c = Document::where('state_document_id', 1)->where('identification_number', $company->identification_number)->where('type_document_id', 4)->whereDate('date_issue', '>=', $desde)->whereDate('date_issue', '<=', $hasta)->get();
        $d = Document::where('state_document_id', 1)->where('identification_number', $company->identification_number)->where('type_document_id', 5)->whereDate('date_issue', '>=', $desde)->whereDate('date_issue', '<=', $hasta)->get();
        $n = DocumentPayroll::where('state_document_id', 1)->where('identification_number', $company->identification_number)->where('type_document_id', 9)->whereDate('date_issue', '>=', $desde)->whereDate('date_issue', '<=', $hasta)->get();
        $na = DocumentPayroll::where('state_document_id', 1)->where('identification_number', $company->identification_number)->where('type_document_id', 10)->whereDate('date_issue', '>=', $desde)->whereDate('date_issue', '<=', $hasta)->get();
        $ds = Document::where('state_document_id', 1)->where('identification_number', $company->identification_number)->where('type_document_id', 11)->whereDate('date_issue', '>=', $desde)->whereDate('date_issue', '<=', $hasta)->get();
        $nds = Document::where('state_document_id', 1)->where('identification_number', $company->identification_number)->where('type_document_id', 13)->whereDate('date_issue', '>=', $desde)->whereDate('date_issue', '<=', $hasta)->get();
        $pos = Document::where('state_document_id', 1)->where('identification_number', $company->identification_number)->where('type_document_id', 15)->whereDate('date_issue', '>=', $desde)->whereDate('date_issue', '<=', $hasta)->get();
        $ncp = Document::where('state_document_id', 1)->where('identification_number', $company->identification_number)->where('type_document_id', 26)->whereDate('date_issue', '>=', $desde)->whereDate('date_issue', '<=', $hasta)->get();
        $ndp = Document::where('state_document_id', 1)->where('identification_number', $company->identification_number)->where('type_document_id', 25)->whereDate('date_issue', '>=', $desde)->whereDate('date_issue', '<=', $hasta)->get();

        $invoice = (object)[
            'name' => 'Factura de Venta Nacional',
            'count' => count($i),
        ];

        $credit_note = (object)[
            'name' => 'Nota Credito',
            'count' => count($c),
        ];

        $debit_note = (object)[
            'name' => 'Nota Debito',
            'count' => count($d),
        ];

        $payroll = (object)[
            'name' => 'Nomina Individual',
            'count' => count($n),
        ];

        $payroll_note = (object)[
            'name' => 'Notas de Ajuste de Nomina Individual',
            'count' => count($na),
        ];

        $support_document = (object)[
            'name' => 'Documento Soporte a No Obligados a Facturar',
            'count' => count($ds),
        ];

        $support_document_note = (object)[
            'name' => 'Notas de Ajuste al Documento Soporte a No Obligados a Facturar',
            'count' => count($nds),
        ];

        $pos = (object)[
            'name' => 'Documento Equivalente POS',
            'count' => count($pos),
        ];

        $pos_credit_note = (object)[
            'name' => 'Nota Credito a Documento POS',
            'count' => count($ncp),
        ];

        $pos_debit_note = (object)[
            'name' => 'Nota Debito a Documento POS',
            'count' => count($ndp),
        ];

        return [
            'success' => true,
            'message' => 'NIT Encontrado',
            'data'=> array($invoice, $credit_note, $debit_note, $payroll, $payroll_note, $support_document, $support_document_note, $pos, $pos_credit_note, $pos_debit_note),
            'company' => $company->user->name
        ];
    }

    public function information($nit, $desde = NULL, $hasta = NULL)
    {
        if($desde && !$hasta)
          $hasta = $desde;
        else
          if(!$desde && $hasta)
            $desde = $hasta;
          else
            if(!$desde && !$hasta)
            {
                $desde = '1900-01-01';
                $hasta = '2100-01-01';
            }

        $company = Company::where('identification_number', $nit)->first();

        if(!$company)
        {
            return [
                'success' => false,
                'message' => 'No se encontraron datos del NIT',
            ];
        }

        $i = Document::where('state_document_id', 1)->where('identification_number', $company->identification_number)->where('type_document_id', 1)->whereDate('date_issue', '>=', $desde)->whereDate('date_issue', '<=', $hasta)->get();
        $c = Document::where('state_document_id', 1)->where('identification_number', $company->identification_number)->where('type_document_id', 4)->whereDate('date_issue', '>=', $desde)->whereDate('date_issue', '<=', $hasta)->get();
        $d = Document::where('state_document_id', 1)->where('identification_number', $company->identification_number)->where('type_document_id', 5)->whereDate('date_issue', '>=', $desde)->whereDate('date_issue', '<=', $hasta)->get();

        $invoice = (object)[
            'type_document_id' => 1,
            'name' => 'Factura de Venta Nacional',
            'count' => count($i),
            'documents' => $i
        ];

        $credit_note = (object)[
            'type_document_id' => 4,
            'name' => 'Nota Credito',
            'count' => count($c),
            'documents' => $c
        ];

        $debit_note = (object)[
            'type_document_id' => 5,
            'name' => 'Nota Debito',
            'count' => count($d),
            'documents' => $d
        ];

        return [
            'success' => true,
            'message' => 'NIT Encontrado',
            'data'=> array($invoice, $credit_note, $debit_note),
            'company' => $company->user->name
        ];
    }

    public function information_by_page($nit, $page)
    {
        if($page <= 0)
            $page = 1;

        $company = Company::where('identification_number', $nit)->first();

        if(!$company)
        {
            return [
                'success' => false,
                'message' => 'No se encontraron datos del NIT',
            ];
        }

        $perPage = 100;

        $i = Document::where('state_document_id', 1)->where('identification_number', $company->identification_number)->where('type_document_id', 1)->skip(($page - 1) * $perPage)->take($perPage)->oldest()->get();
        $c = Document::where('state_document_id', 1)->where('identification_number', $company->identification_number)->where('type_document_id', 4)->skip(($page - 1) * $perPage)->take($perPage)->oldest()->get();
        $d = Document::where('state_document_id', 1)->where('identification_number', $company->identification_number)->where('type_document_id', 5)->skip(($page - 1) * $perPage)->take($perPage)->oldest()->get();

        $invoice = (object)[
            'name' => 'Factura de Venta Nacional',
            'count' => count($i),
            'documents' => $i
        ];

        $credit_note = (object)[
            'name' => 'Nota Credito',
            'count' => count($c),
            'documents' => $c
        ];

        $debit_note = (object)[
            'name' => 'Nota Debito',
            'count' => count($d),
            'documents' => $d
        ];

        return [
            'success' => true,
            'message' => 'NIT Encontrado',
            'data'=> array($invoice, $credit_note, $debit_note),
            'company' => $company->user->name
        ];
    }

}
