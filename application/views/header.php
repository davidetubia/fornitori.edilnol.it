<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html lang="it">
<head>
	<meta charset="utf-8">
	<title>Edilnol | Portale fornitori</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/main.css">
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

<nav class="bg-eblu-900 border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="<?php echo site_url(); ?>" class="flex items-center">
        <img src="<?php echo base_url(); ?>/assets/images/logo-edilnol.png" class="h-10 mr-3" alt="Logo Edilnol" />
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <?php if($this->session->userdata('user')): ?>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0">
        <li>
            <a 
            href="<?php echo site_url('fornitore/profilo'); ?>" 
            class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:p-0 aria-current="page">
                Il tuo profilo
            </a>
        </li>
        <li>
            <a 
            href="<?php echo site_url('logout'); ?>" 
            class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:p-0 aria-current="page">
                Esci
            </a>
        </li>
        </ul>
    </div>
    <?php else: ?>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0">
        <li>
            <a 
            href="<?php echo site_url(); ?>" 
            class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:p-0 aria-current="page">
                Accedi
            </a>
        </li>
        <li>
            <a 
            href="<?php echo site_url('registrati'); ?>" 
            class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:p-0 aria-current="page">
                Registrati
            </a>
        </li>
        </ul>
    </div>
    <?php endif; ?>
    </div>
</nav>

<div>
