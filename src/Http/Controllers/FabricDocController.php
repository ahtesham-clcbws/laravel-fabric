<?php

namespace CLCBWS\Fabric\Http\Controllers;

use CLCBWS\Fabric\Registry\ComponentRegistry;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;

class FabricDocController extends Controller
{
    public function index()
    {
        $templates = ComponentRegistry::getTemplates();
        return view('fabric::docs.index', compact('templates'));
    }

    public function template(string $template)
    {
        $sections = ComponentRegistry::getSections($template);
        return view('fabric::docs.template', compact('template', 'sections'));
    }

    public function component(string $template, string $section)
    {
        return view('fabric::docs.component', compact('template', 'section'));
    }
}
