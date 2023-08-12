<?php defined('BASEPATH') or exit('No direct script access allowed');

class Menu
{
	var $menu;
	function __construct()
	{
	}
	public function init()
	{
		if ($_SESSION['tipo_usua'] == 3) {
			$this->menu[] = array(
				"name" => "Perfil",
				"icon" => "fas fa-home",
				"url" => "inicio/dashboard",
				"add" =>
				[
					[
						"name" => "Dashboard",
						"icon" => "fas fa-tachometer-alt",
						"url" => "inicio/dashboard",
					],

				]
			);
		};

		if ($_SESSION['tipo_usua'] == 2) {
			$this->menu[] = array(
				"name" => "Inicio",
				"icon" => "fas fa-home",
				"url" => "inicio/dashboard",
				"add" =>
				[
					[
						"name" => "Dashboard",
						"icon" => "fas fa-tachometer-alt",
						"url" => "inicio/dashboard",
					],

				]
			);
		};

		if ($_SESSION['tipo_usua'] == 2) {
			$this->menu[] = array(
				"name" => "Producto",
				"icon" => "fas fa-store",
				"url" => "producto/inicio",
				"add" => array(
					array(
						"name" => "Lista",
						"icon" => "fas fa-list-ol",
						"url" => "producto/lista",
					),
					array(
						"name" => "Ventas",
						"icon" => "fas fa-shopping-cart",
						"url" => "producto/ventas",
					)
				)
			);
		};
		if ($_SESSION['tipo_usua'] == 2) {
			$this->menu[] = array(
				"name" => "Terapias",
				"icon" => "fas fa-hand-holding",
				"url" => "terapia/inicio",
				"add" => array(
					array(
						"name" => "Lista",
						"icon" => "fas fa-list-ol",
						"url" => "terapia/lista",
					),
					array(
						"name" => "Reserva",
						"icon" => "fas fa-calendar-alt",
						"url" => "terapia/reserva",
					)
				)
			);
		};
		if ($_SESSION['tipo_usua'] == 2) {
			$this->menu[] = array(
				"name" => "Cursos",
				"icon" => "fas fa-allergies",
				"url" => "curso/inicio",
				"add" => array(
					array(
						"name" => "Lista",
						"icon" => "fas fa-list-ol",
						"url" => "curso/lista",
					),
					array(
						"name" => "Preincripcion",
						"icon" => "fas fa-clipboard-list",
						"url" => "curso/preinscripcion",
					)
				)
			);
		};
		if ($_SESSION['tipo_usua'] == 2) {
			$this->menu[] = array(
				"name" => "Clientes",
				"icon" => "fas fa-users",
				"url" => "clientes/inicio",
				"add" => array(

					array(
						"name" => "Lista",
						"icon" => "fas fa-list",
						"url" => "clientes/lista",
					)
				)
			);
		};
		if ($_SESSION['tipo_usua'] == 2) {
			$this->menu[] = array(
				"name" => "Configuracion",
				"icon" => "fas fa-cog",
				"url" => "configuracion/inicio",
				"add" => array(

					array(
						"name" => "Usuario",
						"icon" => "fas fa-users",
						"url" => "configuracion/usuario",
					),
					array(
						"name" => "Sliders",
						"icon" => "fas fa-images",
						"url" => "configuracion/slider",
					),
				)
			);
		};
	}
	public function getMenu()
	{
		$this->init();
		return $this->menu;
	}
}
