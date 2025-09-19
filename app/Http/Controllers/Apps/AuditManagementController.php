<?php

namespace App\Http\Controllers\Apps;

use App\DataTables\AuditsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditManagementController extends Controller
{
    public function index(AuditsDataTable $dataTable)
    {
        return $dataTable->render('pages.apps.audit-management.audits.list');
    }
}
