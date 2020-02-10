<?php
/**
 * Created by PhpStorm.
 * User: redfu
 * Date: 22/11/2018
 * Time: 22:42
 */
use yii\helpers\Html;

$this->title = 'CifiMad';
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<link rel="shortcut icon" href="https://www.cifimad.es/wp-content/uploads/2017/10/favicon-2.ico" type="image/x-icon"/>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="https://www.cifimad.es/xmlrpc.php">
	<title><?= Html::encode(Yii::$app->name . ' - ' . $this->title) ?></title>

	<!-- This site is optimized with the Yoast SEO plugin v7.2 - https://yoast.com/wordpress/plugins/seo/ -->
	<!-- Aviso solo para el Administrador: esta página no muestra una meta description porque no la tiene. Haz una de estas dos cosas: escribe una específicamente para esta página o ve al menú SEO -&gt; Apariencia en la búsqueda y configura una plantilla. -->
	<link rel="canonical" href="http://data.cifimad.es/member/consent/" />
	<meta property="og:locale" content="es_ES" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="CifiMad" />
	<meta property="og:url" content="http://data.cifimad.es/member/consent/" />
	<meta property="og:site_name" content="CifiMad" />
	<!-- / Yoast SEO plugin. -->

	<link rel='dns-prefetch' href='//maps.google.com' />
	<link rel='dns-prefetch' href='//fonts.googleapis.com' />
	<link rel='dns-prefetch' href='//s.w.org' />
	<link rel="alternate" type="application/rss+xml" title="CifiMad &raquo; Feed" href="https://www.cifimad.es/feed/" />
	<link rel="alternate" type="application/rss+xml" title="CifiMad &raquo; RSS de los comentarios" href="https://www.cifimad.es/comments/feed/" />
	<!-- This site uses the Google Analytics by MonsterInsights plugin v7.0.5 - Using Analytics tracking - https://www.monsterinsights.com/ -->
	<!-- Note: The site owner has disabled Google Analytics tracking for your user role. -->
	<script type="text/javascript" data-cfasync="false">
		var mi_track_user = false;

		var disableStr = 'ga-disable-UA-59187728-1';

		/* Function to detect opted out users */
		function __gaTrackerIsOptedOut() {
			return document.cookie.indexOf(disableStr + '=true') > -1;
		}

		/* Disable tracking if the opt-out cookie exists. */
		if ( __gaTrackerIsOptedOut() ) {
			window[disableStr] = true;
		}

		/* Opt-out function */
		function __gaTrackerOptout() {
			document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
			window[disableStr] = true;
		}

		if ( mi_track_user ) {
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','__gaTracker');

			__gaTracker('create', 'UA-59187728-1', 'auto');
			__gaTracker('set', 'forceSSL', true);
			__gaTracker('send','pageview');
		} else {
			console.log( "Note: The site owner has disabled Google Analytics tracking for your user role." );
			(function() {
				/* https://developers.google.com/analytics/devguides/collection/analyticsjs/ */
				var noopfn = function() {
					return null;
				};
				var noopnullfn = function() {
					return null;
				};
				var Tracker = function() {
					return null;
				};
				var p = Tracker.prototype;
				p.get = noopfn;
				p.set = noopfn;
				p.send = noopfn;
				var __gaTracker = function() {
					var len = arguments.length;
					if ( len === 0 ) {
						return;
					}
					var f = arguments[len-1];
					if ( typeof f !== 'object' || f === null || typeof f.hitCallback !== 'function' ) {
						console.log( 'Not running function __gaTracker(' + arguments[0] + " ....) because you\'re not being tracked. Note: The site owner has disabled Google Analytics tracking for your user role.");
						return;
					}
					try {
						f.hitCallback();
					} catch (ex) {

					}
				};
				__gaTracker.create = function() {
					return new Tracker();
				};
				__gaTracker.getByName = noopnullfn;
				__gaTracker.getAll = function() {
					return [];
				};
				__gaTracker.remove = noopfn;
				window['__gaTracker'] = __gaTracker;
			})();
		}
	</script>
	<!-- / Google Analytics by MonsterInsights -->
	<script type="text/javascript">
		window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/2.3\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/2.3\/svg\/","svgExt":".svg","source":{"concatemoji":"https:\/\/www.cifimad.es\/wp-includes\/js\/wp-emoji-release.min.js?ver=4.8.7"}};
		!function(a,b,c){function d(a){var b,c,d,e,f=String.fromCharCode;if(!k||!k.fillText)return!1;switch(k.clearRect(0,0,j.width,j.height),k.textBaseline="top",k.font="600 32px Arial",a){case"flag":return k.fillText(f(55356,56826,55356,56819),0,0),b=j.toDataURL(),k.clearRect(0,0,j.width,j.height),k.fillText(f(55356,56826,8203,55356,56819),0,0),c=j.toDataURL(),b!==c&&(k.clearRect(0,0,j.width,j.height),k.fillText(f(55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447),0,0),b=j.toDataURL(),k.clearRect(0,0,j.width,j.height),k.fillText(f(55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447),0,0),c=j.toDataURL(),b!==c);case"emoji4":return k.fillText(f(55358,56794,8205,9794,65039),0,0),d=j.toDataURL(),k.clearRect(0,0,j.width,j.height),k.fillText(f(55358,56794,8203,9794,65039),0,0),e=j.toDataURL(),d!==e}return!1}function e(a){var c=b.createElement("script");c.src=a,c.defer=c.type="text/javascript",b.getElementsByTagName("head")[0].appendChild(c)}var f,g,h,i,j=b.createElement("canvas"),k=j.getContext&&j.getContext("2d");for(i=Array("flag","emoji4"),c.supports={everything:!0,everythingExceptFlag:!0},h=0;h<i.length;h++)c.supports[i[h]]=d(i[h]),c.supports.everything=c.supports.everything&&c.supports[i[h]],"flag"!==i[h]&&(c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&c.supports[i[h]]);c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&!c.supports.flag,c.DOMReady=!1,c.readyCallback=function(){c.DOMReady=!0},c.supports.everything||(g=function(){c.readyCallback()},b.addEventListener?(b.addEventListener("DOMContentLoaded",g,!1),a.addEventListener("load",g,!1)):(a.attachEvent("onload",g),b.attachEvent("onreadystatechange",function(){"complete"===b.readyState&&c.readyCallback()})),f=c.source||{},f.concatemoji?e(f.concatemoji):f.wpemoji&&f.twemoji&&(e(f.twemoji),e(f.wpemoji)))}(window,document,window._wpemojiSettings);
	</script>
	<style type="text/css">
		img.wp-smiley,
		img.emoji {
			display: inline !important;
			border: none !important;
			box-shadow: none !important;
			height: 1em !important;
			width: 1em !important;
			margin: 0 .07em !important;
			vertical-align: -0.1em !important;
			background: none !important;
			padding: 0 !important;
		}
	</style>
	<link rel='stylesheet' id='font-awesome-css'  href='https://www.cifimad.es/wp-content/plugins/menu-icons/includes/library/icon-picker/css/types/font-awesome.min.css?ver=4.6.1' type='text/css' media='all' />
	<link rel='stylesheet' id='menu-icons-extra-css'  href='https://www.cifimad.es/wp-content/plugins/menu-icons/css/extra.min.css?ver=0.10.2' type='text/css' media='all' />
	<link rel='stylesheet' id='contact-form-7-css'  href='https://www.cifimad.es/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=4.9' type='text/css' media='all' />
	<link rel='stylesheet' id='mptt-style-css'  href='https://www.cifimad.es/wp-content/plugins/mp-timetable/media/css/style.css?ver=2.1.10' type='text/css' media='all' />
	<link rel='stylesheet' id='bootstrap-css'  href='https://www.cifimad.es/wp-content/plugins/responsive-table-for-woocommerce/public/css/bootstrap.min.css?ver=4.8.7' type='text/css' media='all' />
	<link rel='stylesheet' id='woocommerce-layout-css'  href='https://www.cifimad.es/wp-content/plugins/woocommerce/assets/css/woocommerce-layout.css?ver=3.2.3' type='text/css' media='all' />
	<link rel='stylesheet' id='woocommerce-smallscreen-css'  href='https://www.cifimad.es/wp-content/plugins/woocommerce/assets/css/woocommerce-smallscreen.css?ver=3.2.3' type='text/css' media='only screen and (max-width: 768px)' />
	<link rel='stylesheet' id='woocommerce-general-css'  href='https://www.cifimad.es/wp-content/plugins/woocommerce/assets/css/woocommerce.css?ver=3.2.3' type='text/css' media='all' />
	<link rel='stylesheet' id='wpml-legacy-horizontal-list-0-css'  href='https://www.cifimad.es/wp-content/plugins/sitepress-multilingual-cms/templates/language-switchers/legacy-list-horizontal/style.css?ver=1' type='text/css' media='all' />
	<link rel='stylesheet' id='wpml-menu-item-0-css'  href='https://www.cifimad.es/wp-content/plugins/sitepress-multilingual-cms/templates/language-switchers/menu-item/style.css?ver=1' type='text/css' media='all' />
	<link rel='stylesheet' id='wcff-style-css'  href='https://www.cifimad.es/wp-content/plugins/wc-fields-factory/classes/../assets/css/wcff.css?ver=4.8.7' type='text/css' media='all' />
	<link rel='stylesheet' id='wccpf-font-end-style-css'  href='https://www.cifimad.es/wp-content/plugins/wc-fields-factory/assets/css/wccpf-front-end.css?ver=4.8.7' type='text/css' media='all' />
	<link rel='stylesheet' id='spectrum-css-css'  href='https://www.cifimad.es/wp-content/plugins/wc-fields-factory/assets/css/spectrum.css?ver=4.8.7' type='text/css' media='all' />
	<link rel='stylesheet' id='yoast-seo-adminbar-css'  href='https://www.cifimad.es/wp-content/plugins/wordpress-seo/css/dist/adminbar-720.min.css?ver=7.2' type='text/css' media='all' />
	<link rel='stylesheet' id='thm-style-css'  href='https://www.cifimad.es/wp-content/themes/eventum/style.css?ver=4.8.7' type='text/css' media='all' />
	<link rel='stylesheet' id='buttons-css'  href='https://www.cifimad.es/wp-includes/css/buttons.min.css?ver=4.8.7' type='text/css' media='all' />
	<link rel='stylesheet' id='mediaelement-css'  href='https://www.cifimad.es/wp-includes/js/mediaelement/mediaelementplayer.min.css?ver=2.22.0' type='text/css' media='all' />
	<link rel='stylesheet' id='wp-mediaelement-css'  href='https://www.cifimad.es/wp-includes/js/mediaelement/wp-mediaelement.min.css?ver=4.8.7' type='text/css' media='all' />
	<link rel='stylesheet' id='media-views-css'  href='https://www.cifimad.es/wp-includes/css/media-views.min.css?ver=4.8.7' type='text/css' media='all' />
	<link rel='stylesheet' id='imgareaselect-css'  href='https://www.cifimad.es/wp-includes/js/imgareaselect/imgareaselect.css?ver=0.9.8' type='text/css' media='all' />
	<link rel='stylesheet' id='quick-preset-css'  href='https://www.cifimad.es/wp-content/themes/eventum/quick-preset.php?ver=4.8.7' type='text/css' media='all' />
	<link rel='stylesheet' id='quick-style-css'  href='https://www.cifimad.es/wp-content/themes/eventum/quick-style.php?ver=4.8.7' type='text/css' media='all' />
	<link rel='stylesheet' id='js_composer_front-css'  href='https://www.cifimad.es/wp-content/plugins/js_composer/assets/css/js_composer.min.css?ver=5.1.1' type='text/css' media='all' />
	<link rel='stylesheet' id='redux-google-fonts-themeum_options-css'  href='https://fonts.googleapis.com/css?family=Roboto%3A100%2C300%2C400%2C500%2C700%2C900%2C100italic%2C300italic%2C400italic%2C500italic%2C700italic%2C900italic&#038;ver=1509800736' type='text/css' media='all' />
	<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/jquery/jquery.js?ver=1.12.4'></script>
	<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.1'></script>
	<script type='text/javascript' src='https://www.cifimad.es/wp-content/plugins/woocommerce-multilingual/res/js/front-scripts.min.js?ver=4.2.5'></script>
	<script type='text/javascript'>
		/* <![CDATA[ */
		var actions = {"is_lang_switched":"0","is_currency_switched":"0","force_reset":"0","cart_fragment":"wc_fragments_92f0ff2f9c7ff417c6ef2afda7e8f894"};
		/* ]]> */
	</script>
	<script type='text/javascript' src='https://www.cifimad.es/wp-content/plugins/woocommerce-multilingual/res/js/cart_widget.min.js?ver=4.2.5'></script>
	<script type='text/javascript'>
		/* <![CDATA[ */
		var monsterinsights_frontend = {"js_events_tracking":"true","is_debug_mode":"false","download_extensions":"doc,exe,js,pdf,ppt,tgz,zip,xls","inbound_paths":"","home_url":"https:\/\/www.cifimad.es","track_download_as":"event","internal_label":"int","hash_tracking":"false"};
		/* ]]> */
	</script>
	<script type='text/javascript' src='https://www.cifimad.es/wp-content/plugins/google-analytics-for-wordpress/assets/js/frontend.min.js?ver=7.0.5'></script>
	<script type='text/javascript'>
		/* <![CDATA[ */
		var wc_add_to_cart_params = {"ajax_url":"\/wp-admin\/admin-ajax.php","wc_ajax_url":"https:\/\/www.cifimad.es\/?wc-ajax=%%endpoint%%","i18n_view_cart":"Ver carrito","cart_url":"https:\/\/www.cifimad.es\/carrito\/","is_cart":"","cart_redirect_after_add":"yes"};
		/* ]]> */
	</script>
	<script type='text/javascript' src='https://www.cifimad.es/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js?ver=3.2.3'></script>
	<script type='text/javascript' src='https://www.cifimad.es/wp-content/plugins/js_composer/assets/js/vendors/woocommerce-add-to-cart.js?ver=5.1.1'></script>
	<script type='text/javascript' src='https://www.cifimad.es/wp-content/plugins/wc-fields-factory/assets/js/spectrum.js?ver=4.8.7'></script>
	<script type='text/javascript' src='https://www.cifimad.es/wp-content/plugins/wc-fields-factory/assets/js/wccpf-front-end.js?ver=4.8.7'></script>
	<script type='text/javascript' src='https://maps.google.com/maps/api/js?key=AIzaSyDh1eLs0rpNzEL9GpVMxJDu5ggCZqEtcbI&#038;ver=4.8.7'></script>
	<script type='text/javascript'>
		/* <![CDATA[ */
		var userSettings = {"url":"\/","uid":"6","time":"1542827129","secure":"1"};
		/* ]]> */
	</script>
	<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/utils.min.js?ver=4.8.7'></script>
	<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/plupload/plupload.full.min.js?ver=2.1.8'></script>
	<!--[if lt IE 8]>
	<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/json2.min.js?ver=2015-05-03'></script>
	<![endif]-->
	<link rel='https://api.w.org/' href='https://www.cifimad.es/wp-json/' />
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://www.cifimad.es/xmlrpc.php?rsd" />
	<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="https://www.cifimad.es/wp-includes/wlwmanifest.xml" />
	<noscript><style type="text/css">.mptt-shortcode-wrapper .mptt-shortcode-table:first-of-type{display:table!important}.mptt-shortcode-wrapper .mptt-shortcode-table .mptt-event-container:hover{height:auto!important;min-height:100%!important}body.mprm_ie .mptt-shortcode-wrapper .mptt-event-container{height:auto!important}@media (max-width:767px){.mptt-shortcode-wrapper .mptt-shortcode-table:first-of-type{display:none!important}}</style></noscript><style>.woocommerce div.product .in_stock_color { color: #77a464 }ul.products .in_stock_color { color: #77a464 }.woocommerce div.product .only_s_left_in_stock_color { color: #77a464 }ul.products .only_s_left_in_stock_color { color: #77a464 }.woocommerce div.product .s_in_stock_color { color: #77a464 }ul.products .s_in_stock_color { color: #77a464 }.woocommerce div.product .available_on_backorder_color { color: #77a464 }ul.products .available_on_backorder_color { color: #77a464 }.woocommerce div.product .can_be_backordered_color { color: #77a464 }ul.products .can_be_backordered_color { color: #77a464 }.woocommerce div.product .out_of_stock_color { color: #0883e2 }ul.products .out_of_stock_color { color: #0883e2 }</style><!-- woo-custom-stock-status-color-css -->	<noscript><style>.woocommerce-product-gallery{ opacity: 1 !important; }</style></noscript>
	<meta name="generator" content="Powered by Visual Composer - drag and drop page builder for WordPress."/>
	<!--[if lte IE 9]><link rel="stylesheet" type="text/css" href="https://www.cifimad.es/wp-content/plugins/js_composer/assets/css/vc_lte_ie9.min.css" media="screen"><![endif]--><style type="text/css" media="print">#wpadminbar { display:none; }</style>
	<style type="text/css" media="screen">
		html { margin-top: 32px !important; }
		* html body { margin-top: 32px !important; }
		@media screen and ( max-width: 782px ) {
			html { margin-top: 46px !important; }
			* html body { margin-top: 46px !important; }
		}
	</style>
	<style type="text/css" title="dynamic-css" class="options-output">body{font-family:Roboto;font-weight:300;font-style:normal;color:#333;font-size:16px;}#main-menu .nav>li>a, #main-menu ul.sub-menu li > a{font-family:Roboto;font-weight:500;font-style:normal;font-size:15px;}h1{font-family:Roboto;font-weight:700;font-style:normal;color:#000;font-size:42px;}h2{font-family:Roboto;font-weight:700;font-style:normal;color:#000;font-size:36px;}h3{font-family:Roboto;font-weight:700;font-style:normal;color:#000;font-size:24px;}h4{font-family:Roboto;font-weight:500;font-style:normal;color:#000;font-size:16px;}h5{font-family:Roboto;font-weight:700;font-style:normal;color:#000;font-size:16px;}footer{padding-top:10px;padding-bottom:10px;}</style><style type="text/css" data-type="vc_shortcodes-custom-css">.vc_custom_1509544525562{margin-top: 0px !important;margin-bottom: 0px !important;padding-top: 0px !important;padding-bottom: 0px !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}</style><noscript><style type="text/css"> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript>
    <link rel="stylesheet" href="/css/public.css?v1.0"/>
    <script type='text/javascript' src='/js/validateForm.js?v1.0'></script>
</head>


<body class="page-template page-template-homepage page-template-homepage-php page page-id-1661 logged-in admin-bar no-customize-support fullwidth-bg wpb-js-composer js-comp-ver-5.1.1 vc_responsive ">
<div id="page" class="hfeed site fullwidth">
	<header id="masthead" class="site-header header solid">
		<div id="header-container">
			<div id="navigation" class="container">
				<div class="row">
					<div class="col-sm-3">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<div class="logo-wrapper">
								<a class="navbar-brand" href="https://www.cifimad.es">
									<img class="enter-logo img-responsive" src="https://www.cifimad.es/wp-content/uploads/2017/09/logo-cifimad.png" alt="" title="">
								</a>
							</div>
						</div>
					</div>

					<div class="col-sm-9 woo-menu-item-add">
                                                                <span id="themeum-woo-cart" class="woo-cart" style="display:none;">
                                                                                        <span class="woo-cart-items">
                                                <span class="cart-has-products">0</span>
                                            </span>
                                            <i class="fa fa-shopping-cart"></i>

                                        <div class="widget woocommerce widget_shopping_cart"><h2 class="widgettitle"> </h2><div class="widget_shopping_cart_content"></div></div>                                    </span>


						<div id="main-menu" class="hidden-xs">

							<ul id="menu-menu-cifimad" class="nav"><li class=" menu-item menu-item-type-post_type menu-item-object-page menu-item-home has-menu-child"><a href="https://www.cifimad.es/">Inicio</a></li>
								<li class=" menu-item menu-item-type-post_type menu-item-object-page has-menu-child"><a href="https://www.cifimad.es/actividades-horarios/">Programa</a></li>
								<li class=" menu-item menu-item-type-post_type menu-item-object-page has-menu-child"><a href="https://www.cifimad.es/invitados-estrella/">Invitados</a></li>
								<li class=" menu-item menu-item-type-post_type menu-item-object-page has-menu-child"><a href="https://www.cifimad.es/actividades-2020/concurso-de-cosplay-3/">Cosplay</a></li>
								<li class=" menu-item menu-item-type-post_type menu-item-object-page has-menu-child"><a href="https://www.cifimad.es/como-llegar/">Sede</a></li>
								<li class=" menu-item menu-item-type-post_type menu-item-object-page has-menu-child"><a href="https://www.cifimad.es/historia/">Historia</a></li>
								<li class=" menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-1661 current_page_item menu-item-has-children active has-menu-child"><a href="https://www.cifimad.es/tienda-entradas/">Tienda</a>
									<ul role="menu" class="sub-menu">
										<li class=" menu-item menu-item-type-post_type menu-item-object-page has-menu-child"><a href="https://www.cifimad.es/productos-tienda/mi-cuenta/">Mi cuenta</a></li>
										<li class=" menu-item menu-item-type-post_type menu-item-object-page has-menu-child"><a href="https://www.cifimad.es/carrito/">Cesta</a></li>
										<li class=" menu-item menu-item-type-post_type menu-item-object-page has-menu-child"><a href="https://www.cifimad.es/informacion-precios/">Información (FAQ)</a></li>
										<li class=" menu-item menu-item-type-post_type menu-item-object-page has-menu-child"><a href="https://www.cifimad.es/contacto/">Contacto</a></li>
									</ul>
								</li>
								<li class="menu-item wpml-ls-slot-46 wpml-ls-item wpml-ls-item-en wpml-ls-menu-item wpml-ls-first-item wpml-ls-last-item has-menu-child"><a href="https://www.cifimad.es/en/shop-tickets/"><img class="wpml-ls-flag" src="https://www.cifimad.es/wp-content/plugins/sitepress-multilingual-cms/res/flags/en.png" alt="en" title="English"></a></li>
								<li><a class="socialicons" target="blank" href="https://www.facebook.com/cifimad"><span></span><i class="_mi _after fa fa-facebook" aria-hidden="true"></i></a></li><li><a class="socialicons" target="blank" href="https://twitter.com/cifimad"><span></span><i class="_mi _after fa fa-twitter" aria-hidden="true"></i></a></li><li><a class="socialicons" target="blank" href="https://www.youtube.com/channel/UC3NZdz0xlDBo03Ye7dntTrQ"><span></span><i class="_mi _after fa fa-youtube" aria-hidden="true"></i></a></li></ul>
						</div><!--/#main-menu-->
					</div>



					<div id="mobile-menu" class="visible-xs">
						<div class="collapse navbar-collapse">
							<ul id="menu-menu-cifimad-1" class="nav navbar-nav"><li id="menu-item-1187" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-1187"><a title="Inicio" href="https://www.cifimad.es/">Inicio</a></li>
								<li id="menu-item-1356" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1356"><a title="Programa" href="https://www.cifimad.es/actividades-horarios/">Programa</a></li>
								<li id="menu-item-1919" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1919"><a title="Invitados" href="https://www.cifimad.es/invitados-estrella/">Invitados</a></li>
								<li id="menu-item-1330" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1330"><a title="Cosplay" href="https://www.cifimad.es/actividades-2020/concurso-de-cosplay-3/">Cosplay</a></li>
								<li id="menu-item-1330" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1330"><a title="Sede" href="https://www.cifimad.es/como-llegar/">Sede</a></li>
								<li id="menu-item-1534" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1534"><a title="Historia" href="https://www.cifimad.es/historia/">Historia</a></li>
								<li id="menu-item-1776" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-1661 current_page_item menu-item-has-children menu-item-1776 active"><a title="Tienda" href="https://www.cifimad.es/tienda-entradas/">Tienda</a>
									<span class="menu-toggler collapsed" data-toggle="collapse" data-target=".collapse-1776">
                <i class="fa fa-angle-right"></i><i class="fa fa-angle-down"></i>
                </span>
									<ul role="menu" class="collapse collapse-1776 ">
										<li id="menu-item-1595" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1595"><a title="Mi cuenta" href="https://www.cifimad.es/productos-tienda/mi-cuenta/">Mi cuenta</a></li>
										<li id="menu-item-1605" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1605"><a title="Cesta" href="https://www.cifimad.es/carrito/">Cesta</a></li>
										<li id="menu-item-1395" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1395"><a title="Información (FAQ)" href="https://www.cifimad.es/informacion-precios/">Información (FAQ)</a></li>
										<li id="menu-item-1764" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1764"><a title="Contacto" href="https://www.cifimad.es/contacto/">Contacto</a></li>
									</ul>
								</li>
								<li id="menu-item-wpml-ls-46-en" class="menu-item wpml-ls-slot-46 wpml-ls-item wpml-ls-item-en wpml-ls-menu-item wpml-ls-first-item wpml-ls-last-item menu-item-wpml-ls-46-en"><a title="&lt;img class=&quot;wpml-ls-flag&quot; src=&quot;https://www.cifimad.es/wp-content/plugins/sitepress-multilingual-cms/res/flags/en.png&quot; alt=&quot;en&quot; title=&quot;English&quot;&gt;" href="https://www.cifimad.es/en/shop-tickets/"><img class="wpml-ls-flag" src="https://www.cifimad.es/wp-content/plugins/sitepress-multilingual-cms/res/flags/en.png" alt="en" title="English"></a></li>
								<li><a class="socialicons" target="blank" href="https://www.facebook.com/cifimad"><span></span><i class="_mi _after fa fa-facebook" aria-hidden="true"></i></a></li><li><a class="socialicons" target="blank" href="https://twitter.com/cifimad"><span></span><i class="_mi _after fa fa-twitter" aria-hidden="true"></i></a></li><li><a class="socialicons" target="blank" href="https://www.youtube.com/channel/UC3NZdz0xlDBo03Ye7dntTrQ"><span></span><i class="_mi _after fa fa-youtube" aria-hidden="true"></i></a></li></ul>                            </div>
					</div><!--/.#mobile-menu-->
				</div><!--/.row-->
			</div><!--/.container-->
		</div>

	</header><!--/#header-->


	<section id="main" class="clearfix">
		<div class="container">
			<div id="content" class="site-content" role="main">

				<?= $content ?>

			</div> <!--/#content-->
		</div> <!--/container-->
	</section> <!--/#main-->

	<!-- start footer -->
	<footer id="footer" class="footer-wrap">
		<div class="footer-wrap-inner">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<a class="footer-logo" href="https://www.cifimad.es">
							<img class="eventum-logo" src="" alt="" title="">
						</a>


						<span class="copyright">
                                <div style="padding-top: 10px;"><a href="http://www.angel-lorente.com"><img class="alignnone wp-image-1676" style="width: auto; margin: 8px;" src="https://www.cifimad.es/wp-content/uploads/2017/10/angel-lorente-1.png" alt="" width="242" height="54" /></a></div>
<div>Web diseñada y creada por <a style="color: #fff;" href="http://www.angel-lorente.com"><strong>Angel Lorente Graciano</strong></a></div>                            </span>


						<ul class="social-icons">
						</ul>

					</div> <!-- end row -->
				</div> <!-- end row -->
			</div> <!-- end container -->
		</div> <!-- end footer-wrap-inner -->
	</footer>
</div> <!-- #page -->




<!--[if lte IE 8]>
<style>
	.attachment:focus {
		outline: #1e8cbe solid;
	}
	.selected.attachment {
		outline: #1e8cbe solid;
	}
</style>
<![endif]-->
<script type="text/html" id="tmpl-media-frame">
	<div class="media-frame-menu"></div>
	<div class="media-frame-title"></div>
	<div class="media-frame-router"></div>
	<div class="media-frame-content"></div>
	<div class="media-frame-toolbar"></div>
	<div class="media-frame-uploader"></div>
</script>

<script type="text/html" id="tmpl-media-modal">
	<div class="media-modal wp-core-ui">
		<button type="button" class="media-modal-close"><span class="media-modal-icon"><span class="screen-reader-text">Cerrar el panel de medios</span></span></button>
		<div class="media-modal-content"></div>
	</div>
	<div class="media-modal-backdrop"></div>
</script>

<script type="text/html" id="tmpl-uploader-window">
	<div class="uploader-window-content">
		<h1>Arrastra archivos para subirlos</h1>
	</div>
</script>

<script type="text/html" id="tmpl-uploader-editor">
	<div class="uploader-editor-content">
		<div class="uploader-editor-title">Arrastra archivos para subirlos</div>
	</div>
</script>

<script type="text/html" id="tmpl-uploader-inline">
	<# var messageClass = data.message ? 'has-upload-message' : 'no-upload-message'; #>
		<# if ( data.canClose ) { #>
			<button class="close dashicons dashicons-no"><span class="screen-reader-text">Cerrar cargador</span></button>
			<# } #>
				<div class="uploader-inline-content {{ messageClass }}">
					<# if ( data.message ) { #>
						<h2 class="upload-message">{{ data.message }}</h2>
						<# } #>
							<div class="upload-ui">
								<h2 class="upload-instructions drop-instructions">Arrastra archivos a cualquier lugar para subirlos</h2>
								<p class="upload-instructions drop-instructions">o</p>
								<button type="button" class="browser button button-hero">Selecciona archivos</button>
							</div>

							<div class="upload-inline-status"></div>

							<div class="post-upload-ui">

								<p class="max-upload-size">Tamaño máximo de archivo: 32 MB.</p>

								<# if ( data.suggestedWidth && data.suggestedHeight ) { #>
									<p class="suggested-dimensions">
										Dimensiones de imagen sugeridas: {{data.suggestedWidth}} por {{data.suggestedHeight}} píxeles.					</p>
									<# } #>

							</div>
				</div>
</script>

<script type="text/html" id="tmpl-media-library-view-switcher">
	<a href="/tienda-entradas/?mode=list" class="view-list">
		<span class="screen-reader-text">Vista de lista</span>
	</a>
	<a href="/tienda-entradas/?mode=grid" class="view-grid current">
		<span class="screen-reader-text">Vista de cuadrícula</span>
	</a>
</script>

<script type="text/html" id="tmpl-uploader-status">
	<h2>Subiendo</h2>
	<button type="button" class="button-link upload-dismiss-errors"><span class="screen-reader-text">Descartar errores</span></button>

	<div class="media-progress-bar"><div></div></div>
	<div class="upload-details">
			<span class="upload-count">
				<span class="upload-index"></span> / <span class="upload-total"></span>
			</span>
		<span class="upload-detail-separator">&ndash;</span>
		<span class="upload-filename"></span>
	</div>
	<div class="upload-errors"></div>
</script>

<script type="text/html" id="tmpl-uploader-status-error">
	<span class="upload-error-filename">{{{ data.filename }}}</span>
	<span class="upload-error-message">{{ data.message }}</span>
</script>

<script type="text/html" id="tmpl-edit-attachment-frame">
	<div class="edit-media-header">
		<button class="left dashicons <# if ( ! data.hasPrevious ) { #> disabled <# } #>"><span class="screen-reader-text">Editar el medio anterior</span></button>
		<button class="right dashicons <# if ( ! data.hasNext ) { #> disabled <# } #>"><span class="screen-reader-text">Editar el siguiente medio</span></button>
	</div>
	<div class="media-frame-title"></div>
	<div class="media-frame-content"></div>
</script>

<script type="text/html" id="tmpl-attachment-details-two-column">
	<div class="attachment-media-view {{ data.orientation }}">
		<div class="thumbnail thumbnail-{{ data.type }}">
			<# if ( data.uploading ) { #>
				<div class="media-progress-bar"><div></div></div>
				<# } else if ( data.sizes && data.sizes.large ) { #>
					<img class="details-image" src="{{ data.sizes.large.url }}" draggable="false" alt="" />
					<# } else if ( data.sizes && data.sizes.full ) { #>
						<img class="details-image" src="{{ data.sizes.full.url }}" draggable="false" alt="" />
						<# } else if ( -1 === jQuery.inArray( data.type, [ 'audio', 'video' ] ) ) { #>
							<img class="details-image icon" src="{{ data.icon }}" draggable="false" alt="" />
							<# } #>

								<# if ( 'audio' === data.type ) { #>
									<div class="wp-media-wrapper">
										<audio style="visibility: hidden" controls class="wp-audio-shortcode" width="100%" preload="none">
											<source type="{{ data.mime }}" src="{{ data.url }}"/>
										</audio>
									</div>
									<# } else if ( 'video' === data.type ) {
										var w_rule = '';
										if ( data.width ) {
										w_rule = 'width: ' + data.width + 'px;';
										} else if ( wp.media.view.settings.contentWidth ) {
										w_rule = 'width: ' + wp.media.view.settings.contentWidth + 'px;';
										}
										#>
										<div style="{{ w_rule }}" class="wp-media-wrapper wp-video">
											<video controls="controls" class="wp-video-shortcode" preload="metadata"
											<# if ( data.width ) { #>width="{{ data.width }}"<# } #>
													<# if ( data.height ) { #>height="{{ data.height }}"<# } #>
															<# if ( data.image && data.image.src !== data.icon ) { #>poster="{{ data.image.src }}"<# } #>>
																	<source type="{{ data.mime }}" src="{{ data.url }}"/>
																	</video>
										</div>
										<# } #>

											<div class="attachment-actions">
												<# if ( 'image' === data.type && ! data.uploading && data.sizes && data.can.save ) { #>
													<button type="button" class="button edit-attachment">Editar imagen</button>
													<# } else if ( 'pdf' === data.subtype && data.sizes ) { #>
														Vista previa del documento					<# } #>
											</div>
		</div>
	</div>
	<div class="attachment-info">
			<span class="settings-save-status">
				<span class="spinner"></span>
				<span class="saved">Guardado.</span>
			</span>
		<div class="details">
			<div class="filename"><strong>Nombre de archivo:</strong> {{ data.filename }}</div>
			<div class="filename"><strong>Tipo de archivo:</strong> {{ data.mime }}</div>
			<div class="uploaded"><strong>Subido el:</strong> {{ data.dateFormatted }}</div>

			<div class="file-size"><strong>Tamaño de archivo:</strong> {{ data.filesizeHumanReadable }}</div>
			<# if ( 'image' === data.type && ! data.uploading ) { #>
				<# if ( data.width && data.height ) { #>
					<div class="dimensions"><strong>Dimensiones:</strong> {{ data.width }} &times; {{ data.height }}</div>
					<# } #>
						<# } #>

							<# if ( data.fileLength ) { #>
								<div class="file-length"><strong>Longitud:</strong> {{ data.fileLength }}</div>
								<# } #>

									<# if ( 'audio' === data.type && data.meta.bitrate ) { #>
										<div class="bitrate">
											<strong>Bitrate:</strong> {{ Math.round( data.meta.bitrate / 1000 ) }}kb/s
											<# if ( data.meta.bitrate_mode ) { #>
												{{ ' ' + data.meta.bitrate_mode.toUpperCase() }}
												<# } #>
										</div>
										<# } #>

											<div class="compat-meta">
												<# if ( data.compat && data.compat.meta ) { #>
													{{{ data.compat.meta }}}
													<# } #>
											</div>
		</div>

		<div class="settings">
			<label class="setting" data-setting="url">
				<span class="name">URL</span>
				<input type="text" value="{{ data.url }}" readonly />
			</label>
			<# var maybeReadOnly = data.can.save || data.allowLocalEdits ? '' : 'readonly'; #>
				<label class="setting" data-setting="title">
					<span class="name">Título</span>
					<input type="text" value="{{ data.title }}" {{ maybeReadOnly }} />
				</label>
				<# if ( 'audio' === data.type ) { #>
					<label class="setting" data-setting="artist">
						<span class="name">Artista</span>
						<input type="text" value="{{ data.artist || data.meta.artist || '' }}" />
					</label>
					<label class="setting" data-setting="album">
						<span class="name">Álbum</span>
						<input type="text" value="{{ data.album || data.meta.album || '' }}" />
					</label>
					<# } #>
						<label class="setting" data-setting="caption">
							<span class="name">Leyenda</span>
							<textarea {{ maybeReadOnly }}>{{ data.caption }}</textarea>
						</label>
						<# if ( 'image' === data.type ) { #>
							<label class="setting" data-setting="alt">
								<span class="name">Texto alternativo</span>
								<input type="text" value="{{ data.alt }}" {{ maybeReadOnly }} />
							</label>
							<# } #>
								<label class="setting" data-setting="description">
									<span class="name">Descripción</span>
									<textarea {{ maybeReadOnly }}>{{ data.description }}</textarea>
								</label>
								<label class="setting">
									<span class="name">Subido por</span>
									<span class="value">{{ data.authorName }}</span>
								</label>
								<# if ( data.uploadedToTitle ) { #>
									<label class="setting">
										<span class="name">Subido a </span>
										<# if ( data.uploadedToLink ) { #>
											<span class="value"><a href="{{ data.uploadedToLink }}">{{ data.uploadedToTitle }}</a></span>
											<# } else { #>
												<span class="value">{{ data.uploadedToTitle }}</span>
												<# } #>
									</label>
									<# } #>
										<div class="attachment-compat"></div>
		</div>

		<div class="actions">
			<a class="view-attachment" href="{{ data.link }}">Ver página de adjuntos</a>
			<# if ( data.can.save ) { #> |
				<a href="post.php?post={{ data.id }}&action=edit">Editar más detalles</a>
				<# } #>
					<# if ( ! data.uploading && data.can.remove ) { #> |
						<button type="button" class="button-link delete-attachment">Borrar permanentemente</button>
						<# } #>
		</div>

	</div>
</script>

<script type="text/html" id="tmpl-attachment">
	<div class="attachment-preview js--select-attachment type-{{ data.type }} subtype-{{ data.subtype }} {{ data.orientation }}">
		<div class="thumbnail">
			<# if ( data.uploading ) { #>
				<div class="media-progress-bar"><div style="width: {{ data.percent }}%"></div></div>
				<# } else if ( 'image' === data.type && data.sizes ) { #>
					<div class="centered">
						<img src="{{ data.size.url }}" draggable="false" alt="" />
					</div>
					<# } else { #>
						<div class="centered">
							<# if ( data.image && data.image.src && data.image.src !== data.icon ) { #>
								<img src="{{ data.image.src }}" class="thumbnail" draggable="false" alt="" />
								<# } else if ( data.sizes && data.sizes.medium ) { #>
									<img src="{{ data.sizes.medium.url }}" class="thumbnail" draggable="false" alt="" />
									<# } else { #>
										<img src="{{ data.icon }}" class="icon" draggable="false" alt="" />
										<# } #>
						</div>
						<div class="filename">
							<div>{{ data.filename }}</div>
						</div>
						<# } #>
		</div>
		<# if ( data.buttons.close ) { #>
			<button type="button" class="button-link attachment-close media-modal-icon"><span class="screen-reader-text">Eliminar</span></button>
			<# } #>
	</div>
	<# if ( data.buttons.check ) { #>
		<button type="button" class="check" tabindex="-1"><span class="media-modal-icon"></span><span class="screen-reader-text">Desmarcar</span></button>
		<# } #>
			<#
				var maybeReadOnly = data.can.save || data.allowLocalEdits ? '' : 'readonly';
				if ( data.describe ) {
				if ( 'image' === data.type ) { #>
				<input type="text" value="{{ data.caption }}" class="describe" data-setting="caption"
				       placeholder="Titula esta imagen&hellip;" {{ maybeReadOnly }} />
				<# } else { #>
					<input type="text" value="{{ data.title }}" class="describe" data-setting="title"
					<# if ( 'video' === data.type ) { #>
						placeholder="Describe este video&hellip;"
						<# } else if ( 'audio' === data.type ) { #>
							placeholder="Describe este archivo de audio&hellip;"
							<# } else { #>
								placeholder="Describe este archivo multimedia&hellip;"
								<# } #> {{ maybeReadOnly }} />
									<# }
										} #>
</script>

<script type="text/html" id="tmpl-attachment-details">
	<h2>
		Detalles de adjuntos			<span class="settings-save-status">
				<span class="spinner"></span>
				<span class="saved">Guardado.</span>
			</span>
	</h2>
	<div class="attachment-info">
		<div class="thumbnail thumbnail-{{ data.type }}">
			<# if ( data.uploading ) { #>
				<div class="media-progress-bar"><div></div></div>
				<# } else if ( 'image' === data.type && data.sizes ) { #>
					<img src="{{ data.size.url }}" draggable="false" alt="" />
					<# } else { #>
						<img src="{{ data.icon }}" class="icon" draggable="false" alt="" />
						<# } #>
		</div>
		<div class="details">
			<div class="filename">{{ data.filename }}</div>
			<div class="uploaded">{{ data.dateFormatted }}</div>

			<div class="file-size">{{ data.filesizeHumanReadable }}</div>
			<# if ( 'image' === data.type && ! data.uploading ) { #>
				<# if ( data.width && data.height ) { #>
					<div class="dimensions">{{ data.width }} &times; {{ data.height }}</div>
					<# } #>

						<# if ( data.can.save && data.sizes ) { #>
							<a class="edit-attachment" href="{{ data.editLink }}&amp;image-editor" target="_blank">Editar imagen</a>
							<# } #>
								<# } #>

									<# if ( data.fileLength ) { #>
										<div class="file-length">Longitud: {{ data.fileLength }}</div>
										<# } #>

											<# if ( ! data.uploading && data.can.remove ) { #>
												<button type="button" class="button-link delete-attachment">Borrar permanentemente</button>
												<# } #>

													<div class="compat-meta">
														<# if ( data.compat && data.compat.meta ) { #>
															{{{ data.compat.meta }}}
															<# } #>
													</div>
		</div>
	</div>

	<label class="setting" data-setting="url">
		<span class="name">URL</span>
		<input type="text" value="{{ data.url }}" readonly />
	</label>
	<# var maybeReadOnly = data.can.save || data.allowLocalEdits ? '' : 'readonly'; #>
		<label class="setting" data-setting="title">
			<span class="name">Título</span>
			<input type="text" value="{{ data.title }}" {{ maybeReadOnly }} />
		</label>
		<# if ( 'audio' === data.type ) { #>
			<label class="setting" data-setting="artist">
				<span class="name">Artista</span>
				<input type="text" value="{{ data.artist || data.meta.artist || '' }}" />
			</label>
			<label class="setting" data-setting="album">
				<span class="name">Álbum</span>
				<input type="text" value="{{ data.album || data.meta.album || '' }}" />
			</label>
			<# } #>
				<label class="setting" data-setting="caption">
					<span class="name">Leyenda</span>
					<textarea {{ maybeReadOnly }}>{{ data.caption }}</textarea>
				</label>
				<# if ( 'image' === data.type ) { #>
					<label class="setting" data-setting="alt">
						<span class="name">Texto alternativo</span>
						<input type="text" value="{{ data.alt }}" {{ maybeReadOnly }} />
					</label>
					<# } #>
						<label class="setting" data-setting="description">
							<span class="name">Descripción</span>
							<textarea {{ maybeReadOnly }}>{{ data.description }}</textarea>
						</label>
</script>

<script type="text/html" id="tmpl-media-selection">
	<div class="selection-info">
		<span class="count"></span>
		<# if ( data.editable ) { #>
			<button type="button" class="button-link edit-selection">Editar selección</button>
			<# } #>
				<# if ( data.clearable ) { #>
					<button type="button" class="button-link clear-selection">Borrar</button>
					<# } #>
	</div>
	<div class="selection-view"></div>
</script>

<script type="text/html" id="tmpl-attachment-display-settings">
	<h2>Ajustes de visualización de adjuntos</h2>

	<# if ( 'image' === data.type ) { #>
		<label class="setting align">
			<span>Alineación</span>
			<select class="alignment"
			        data-setting="align"
			<# if ( data.userSettings ) { #>
				data-user-setting="align"
				<# } #>>

					<option value="left">
						Izquierda					</option>
					<option value="center">
						Centrar					</option>
					<option value="right">
						Derecha					</option>
					<option value="none" selected>
						Ninguna					</option>
					</select>
		</label>
		<# } #>

			<div class="setting">
				<label>
					<# if ( data.model.canEmbed ) { #>
						<span>Incrustar o enlazar</span>
						<# } else { #>
							<span>Enlazado a</span>
							<# } #>

								<select class="link-to"
								        data-setting="link"
								<# if ( data.userSettings && ! data.model.canEmbed ) { #>
									data-user-setting="urlbutton"
									<# } #>>

										<# if ( data.model.canEmbed ) { #>
											<option value="embed" selected>
												Incrustar reproductor de medios					</option>
											<option value="file">
												<# } else { #>
											<option value="none" selected>
												Ninguna					</option>
											<option value="file">
												<# } #>
													<# if ( data.model.canEmbed ) { #>
														Enlace al archivo de medios					<# } else { #>
															Archivo multimedia					<# } #>
											</option>
											<option value="post">
												<# if ( data.model.canEmbed ) { #>
													Enlace a página de adjuntos					<# } else { #>
														Página de adjuntos					<# } #>
											</option>
											<# if ( 'image' === data.type ) { #>
												<option value="custom">
													URL personalizada					</option>
												<# } #>
													</select>
				</label>
				<input type="text" class="link-to-custom" data-setting="linkUrl" />
			</div>

			<# if ( 'undefined' !== typeof data.sizes ) { #>
				<label class="setting">
					<span>Tamaño</span>
					<select class="size" name="size"
					        data-setting="size"
					<# if ( data.userSettings ) { #>
						data-user-setting="imgsize"
						<# } #>>
							<#
								var size = data.sizes['thumbnail'];
								if ( size ) { #>
								<option value="thumbnail" >
									Miniatura &ndash; {{ size.width }} &times; {{ size.height }}
								</option>
								<# } #>
									<#
										var size = data.sizes['medium'];
										if ( size ) { #>
										<option value="medium" >
											Medio &ndash; {{ size.width }} &times; {{ size.height }}
										</option>
										<# } #>
											<#
												var size = data.sizes['large'];
												if ( size ) { #>
												<option value="large" >
													Grande &ndash; {{ size.width }} &times; {{ size.height }}
												</option>
												<# } #>
													<#
														var size = data.sizes['full'];
														if ( size ) { #>
														<option value="full"  selected='selected'>
															Tamaño completo &ndash; {{ size.width }} &times; {{ size.height }}
														</option>
														<# } #>
															</select>
				</label>
				<# } #>
</script>

<script type="text/html" id="tmpl-gallery-settings">
	<h2>Ajustes de galería</h2>

	<label class="setting">
		<span>Enlazado a</span>
		<select class="link-to"
		        data-setting="link"
		<# if ( data.userSettings ) { #>
			data-user-setting="urlbutton"
			<# } #>>

				<option value="post" <# if ( ! wp.media.galleryDefaults.link || 'post' == wp.media.galleryDefaults.link ) {
					#>selected="selected"<# }
						#>>
						Página de adjuntos				</option>
						<option value="file" <# if ( 'file' == wp.media.galleryDefaults.link ) { #>selected="selected"<# } #>>
								Archivo multimedia				</option>
								<option value="none" <# if ( 'none' == wp.media.galleryDefaults.link ) { #>selected="selected"<# } #>>
										Ninguna				</option>
										</select>
	</label>

	<label class="setting">
		<span>Columnas</span>
		<select class="columns" name="columns"
		        data-setting="columns">
			<option value="1" <#
				if ( 1 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
					#>>
					1					</option>
					<option value="2" <#
						if ( 2 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
							#>>
							2					</option>
							<option value="3" <#
								if ( 3 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
									#>>
									3					</option>
									<option value="4" <#
										if ( 4 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
											#>>
											4					</option>
											<option value="5" <#
												if ( 5 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
													#>>
													5					</option>
													<option value="6" <#
														if ( 6 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
															#>>
															6					</option>
															<option value="7" <#
																if ( 7 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
																	#>>
																	7					</option>
																	<option value="8" <#
																		if ( 8 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
																			#>>
																			8					</option>
																			<option value="9" <#
																				if ( 9 == wp.media.galleryDefaults.columns ) { #>selected="selected"<# }
																					#>>
																					9					</option>
		</select>
	</label>

	<label class="setting">
		<span>Orden aleatorio</span>
		<input type="checkbox" data-setting="_orderbyRandom" />
	</label>

	<label class="setting size">
		<span>Tamaño</span>
		<select class="size" name="size"
		        data-setting="size"
		<# if ( data.userSettings ) { #>
			data-user-setting="imgsize"
			<# } #>
				>
				<option value="thumbnail">
					Miniatura					</option>
				<option value="medium">
					Medio					</option>
				<option value="large">
					Grande					</option>
				<option value="full">
					Tamaño completo					</option>
				</select>
	</label>
</script>

<script type="text/html" id="tmpl-playlist-settings">
	<h2>Ajuste de listas de reproducción</h2>

	<# var emptyModel = _.isEmpty( data.model ),
		isVideo = 'video' === data.controller.get('library').props.get('type'); #>

		<label class="setting">
			<input type="checkbox" data-setting="tracklist" <# if ( emptyModel ) { #>
				checked="checked"
				<# } #> />
					<# if ( isVideo ) { #>
						<span>Mostrar lista de vídeos</span>
						<# } else { #>
							<span>Mostrar lista de reproducción</span>
							<# } #>
		</label>

		<# if ( ! isVideo ) { #>
			<label class="setting">
				<input type="checkbox" data-setting="artists" <# if ( emptyModel ) { #>
					checked="checked"
					<# } #> />
						<span>Mostrar nombre de artista en la lista de pistas</span>
			</label>
			<# } #>

				<label class="setting">
					<input type="checkbox" data-setting="images" <# if ( emptyModel ) { #>
						checked="checked"
						<# } #> />
							<span>Mostrar imágenes</span>
				</label>
</script>

<script type="text/html" id="tmpl-embed-link-settings">
	<label class="setting link-text">
		<span>Texto del enlace</span>
		<input type="text" class="alignment" data-setting="linkText" />
	</label>
	<div class="embed-container" style="display: none;">
		<div class="embed-preview"></div>
	</div>
</script>

<script type="text/html" id="tmpl-embed-image-settings">
	<div class="thumbnail">
		<img src="{{ data.model.url }}" draggable="false" alt="" />
	</div>

	<label class="setting caption">
		<span>Leyenda</span>
		<textarea data-setting="caption" />
	</label>

	<label class="setting alt-text">
		<span>Texto alternativo</span>
		<input type="text" data-setting="alt" />
	</label>

	<div class="setting align">
		<span>Alineación</span>
		<div class="button-group button-large" data-setting="align">
			<button class="button" value="left">
				Izquierda				</button>
			<button class="button" value="center">
				Centrar				</button>
			<button class="button" value="right">
				Derecha				</button>
			<button class="button active" value="none">
				Ninguna				</button>
		</div>
	</div>

	<div class="setting link-to">
		<span>Enlazado a</span>
		<div class="button-group button-large" data-setting="link">
			<button class="button" value="file">
				URL de la imagen				</button>
			<button class="button" value="custom">
				URL personalizada				</button>
			<button class="button active" value="none">
				Ninguna				</button>
		</div>
		<input type="text" class="link-to-custom" data-setting="linkUrl" />
	</div>
</script>

<script type="text/html" id="tmpl-image-details">
	<div class="media-embed">
		<div class="embed-media-settings">
			<div class="column-image">
				<div class="image">
					<img src="{{ data.model.url }}" draggable="false" alt="" />

					<# if ( data.attachment && window.imageEdit ) { #>
						<div class="actions">
							<input type="button" class="edit-attachment button" value="Editar Original" />
							<input type="button" class="replace-attachment button" value="Reemplazar" />
						</div>
						<# } #>
				</div>
			</div>
			<div class="column-settings">
				<label class="setting caption">
					<span>Leyenda</span>
					<textarea data-setting="caption">{{ data.model.caption }}</textarea>
				</label>

				<label class="setting alt-text">
					<span>Texto alternativo</span>
					<input type="text" data-setting="alt" value="{{ data.model.alt }}" />
				</label>

				<h2>Ajustes de visualización</h2>
				<div class="setting align">
					<span>Alineación</span>
					<div class="button-group button-large" data-setting="align">
						<button class="button" value="left">
							Izquierda							</button>
						<button class="button" value="center">
							Centrar							</button>
						<button class="button" value="right">
							Derecha							</button>
						<button class="button active" value="none">
							Ninguna							</button>
					</div>
				</div>

				<# if ( data.attachment ) { #>
					<# if ( 'undefined' !== typeof data.attachment.sizes ) { #>
						<label class="setting size">
							<span>Tamaño</span>
							<select class="size" name="size"
							        data-setting="size"
							<# if ( data.userSettings ) { #>
								data-user-setting="imgsize"
								<# } #>>
									<#
										var size = data.sizes['thumbnail'];
										if ( size ) { #>
										<option value="thumbnail">
											Miniatura &ndash; {{ size.width }} &times; {{ size.height }}
										</option>
										<# } #>
											<#
												var size = data.sizes['medium'];
												if ( size ) { #>
												<option value="medium">
													Medio &ndash; {{ size.width }} &times; {{ size.height }}
												</option>
												<# } #>
													<#
														var size = data.sizes['large'];
														if ( size ) { #>
														<option value="large">
															Grande &ndash; {{ size.width }} &times; {{ size.height }}
														</option>
														<# } #>
															<#
																var size = data.sizes['full'];
																if ( size ) { #>
																<option value="full">
																	Tamaño completo &ndash; {{ size.width }} &times; {{ size.height }}
																</option>
																<# } #>
																	<option value="custom">
																		Tamaño personalizado									</option>
																	</select>
						</label>
						<# } #>
							<div class="custom-size<# if ( data.model.size !== 'custom' ) { #> hidden<# } #>">
								<label><span>Ancho <small>(px)</small></span> <input data-setting="customWidth" type="number" step="1" value="{{ data.model.customWidth }}" /></label><span class="sep">&times;</span><label><span>Altura <small>(px)</small></span><input data-setting="customHeight" type="number" step="1" value="{{ data.model.customHeight }}" /></label>
							</div>
							<# } #>

								<div class="setting link-to">
									<span>Enlazado a</span>
									<select data-setting="link">
										<# if ( data.attachment ) { #>
											<option value="file">
												Archivo multimedia							</option>
											<option value="post">
												Página de adjuntos							</option>
											<# } else { #>
												<option value="file">
													URL de la imagen							</option>
												<# } #>
													<option value="custom">
														URL personalizada							</option>
													<option value="none">
														Ninguna							</option>
									</select>
									<input type="text" class="link-to-custom" data-setting="linkUrl" />
								</div>
								<div class="advanced-section">
									<h2><button type="button" class="button-link advanced-toggle">Opciones Avanzadas</button></h2>
									<div class="advanced-settings hidden">
										<div class="advanced-image">
											<label class="setting title-text">
												<span>Atributo "title" de la imagen</span>
												<input type="text" data-setting="title" value="{{ data.model.title }}" />
											</label>
											<label class="setting extra-classes">
												<span>Clases CSS de la imagen</span>
												<input type="text" data-setting="extraClasses" value="{{ data.model.extraClasses }}" />
											</label>
										</div>
										<div class="advanced-link">
											<div class="setting link-target">
												<label><input type="checkbox" data-setting="linkTargetBlank" value="_blank" <# if ( data.model.linkTargetBlank ) { #>checked="checked"<# } #>>Abrir enlace en una pestaña nueva</label>
											</div>
											<label class="setting link-rel">
												<span>Relación del enlace</span>
												<input type="text" data-setting="linkRel" value="{{ data.model.linkClassName }}" />
											</label>
											<label class="setting link-class-name">
												<span>Clases CSS del enlace</span>
												<input type="text" data-setting="linkClassName" value="{{ data.model.linkClassName }}" />
											</label>
										</div>
									</div>
								</div>
			</div>
		</div>
	</div>
</script>

<script type="text/html" id="tmpl-image-editor">
	<div id="media-head-{{ data.id }}"></div>
	<div id="image-editor-{{ data.id }}"></div>
</script>

<script type="text/html" id="tmpl-audio-details">
	<# var ext, html5types = {
		mp3: wp.media.view.settings.embedMimes.mp3,
		ogg: wp.media.view.settings.embedMimes.ogg
		}; #>

		<div class="media-embed media-embed-details">
			<div class="embed-media-settings embed-audio-settings">
				<audio style="visibility: hidden"
				       controls
				       class="wp-audio-shortcode"
				       width="{{ _.isUndefined( data.model.width ) ? 400 : data.model.width }}"
				       preload="{{ _.isUndefined( data.model.preload ) ? 'none' : data.model.preload }}"
				<#
					if ( ! _.isUndefined( data.model.autoplay ) && data.model.autoplay ) {
					#> autoplay<#
						}
						if ( ! _.isUndefined( data.model.loop ) && data.model.loop ) {
						#> loop<#
							}
							#>
							>
							<# if ( ! _.isEmpty( data.model.src ) ) { #>
								<source src="{{ data.model.src }}" type="{{ wp.media.view.settings.embedMimes[ data.model.src.split('.').pop() ] }}" />
								<# } #>

									<# if ( ! _.isEmpty( data.model.mp3 ) ) { #>
										<source src="{{ data.model.mp3 }}" type="{{ wp.media.view.settings.embedMimes[ 'mp3' ] }}" />
										<# } #>
											<# if ( ! _.isEmpty( data.model.ogg ) ) { #>
												<source src="{{ data.model.ogg }}" type="{{ wp.media.view.settings.embedMimes[ 'ogg' ] }}" />
												<# } #>
													<# if ( ! _.isEmpty( data.model.m4a ) ) { #>
														<source src="{{ data.model.m4a }}" type="{{ wp.media.view.settings.embedMimes[ 'm4a' ] }}" />
														<# } #>
															<# if ( ! _.isEmpty( data.model.wav ) ) { #>
																<source src="{{ data.model.wav }}" type="{{ wp.media.view.settings.embedMimes[ 'wav' ] }}" />
																<# } #>
																	</audio>

																	<# if ( ! _.isEmpty( data.model.src ) ) {
																		ext = data.model.src.split('.').pop();
																		if ( html5types[ ext ] ) {
																		delete html5types[ ext ];
																		}
																		#>
																		<label class="setting">
																			<span>SRC</span>
																			<input type="text" disabled="disabled" data-setting="src" value="{{ data.model.src }}" />
																			<button type="button" class="button-link remove-setting">Retire fuente de audio</button>
																		</label>
																		<# } #>
																			<# if ( ! _.isEmpty( data.model.mp3 ) ) {
																				if ( ! _.isUndefined( html5types.mp3 ) ) {
																				delete html5types.mp3;
																				}
																				#>
																				<label class="setting">
																					<span>MP3</span>
																					<input type="text" disabled="disabled" data-setting="mp3" value="{{ data.model.mp3 }}" />
																					<button type="button" class="button-link remove-setting">Retire fuente de audio</button>
																				</label>
																				<# } #>
																					<# if ( ! _.isEmpty( data.model.ogg ) ) {
																						if ( ! _.isUndefined( html5types.ogg ) ) {
																						delete html5types.ogg;
																						}
																						#>
																						<label class="setting">
																							<span>OGG</span>
																							<input type="text" disabled="disabled" data-setting="ogg" value="{{ data.model.ogg }}" />
																							<button type="button" class="button-link remove-setting">Retire fuente de audio</button>
																						</label>
																						<# } #>
																							<# if ( ! _.isEmpty( data.model.m4a ) ) {
																								if ( ! _.isUndefined( html5types.m4a ) ) {
																								delete html5types.m4a;
																								}
																								#>
																								<label class="setting">
																									<span>M4A</span>
																									<input type="text" disabled="disabled" data-setting="m4a" value="{{ data.model.m4a }}" />
																									<button type="button" class="button-link remove-setting">Retire fuente de audio</button>
																								</label>
																								<# } #>
																									<# if ( ! _.isEmpty( data.model.wav ) ) {
																										if ( ! _.isUndefined( html5types.wav ) ) {
																										delete html5types.wav;
																										}
																										#>
																										<label class="setting">
																											<span>WAV</span>
																											<input type="text" disabled="disabled" data-setting="wav" value="{{ data.model.wav }}" />
																											<button type="button" class="button-link remove-setting">Retire fuente de audio</button>
																										</label>
																										<# } #>

																											<# if ( ! _.isEmpty( html5types ) ) { #>
																												<div class="setting">
																													<span>Añadir fuentes alternativas para mejorar la reproducción en HTML5:</span>
																													<div class="button-large">
																														<# _.each( html5types, function (mime, type) { #>
																															<button class="button add-media-source" data-mime="{{ mime }}">{{ type }}</button>
																															<# } ) #>
																													</div>
																												</div>
																												<# } #>

																													<div class="setting preload">
																														<span>Precarga</span>
																														<div class="button-group button-large" data-setting="preload">
																															<button class="button" value="auto">Automático</button>
																															<button class="button" value="metadata">Metadatos</button>
																															<button class="button active" value="none">Ninguna</button>
																														</div>
																													</div>

																													<label class="setting checkbox-setting autoplay">
																														<input type="checkbox" data-setting="autoplay" />
																														<span>Reproducción automática</span>
																													</label>

																													<label class="setting checkbox-setting">
																														<input type="checkbox" data-setting="loop" />
																														<span>Repetir</span>
																													</label>
			</div>
		</div>
</script>

<script type="text/html" id="tmpl-video-details">
	<# var ext, html5types = {
		mp4: wp.media.view.settings.embedMimes.mp4,
		ogv: wp.media.view.settings.embedMimes.ogv,
		webm: wp.media.view.settings.embedMimes.webm
		}; #>

		<div class="media-embed media-embed-details">
			<div class="embed-media-settings embed-video-settings">
				<div class="wp-video-holder">
					<#
						var w = ! data.model.width || data.model.width > 640 ? 640 : data.model.width,
						h = ! data.model.height ? 360 : data.model.height;

						if ( data.model.width && w !== data.model.width ) {
						h = Math.ceil( ( h * w ) / data.model.width );
						}
						#>

						<#  var w_rule = '', classes = [],
							w, h, settings = wp.media.view.settings,
							isYouTube = isVimeo = false;

							if ( ! _.isEmpty( data.model.src ) ) {
							isYouTube = data.model.src.match(/youtube|youtu\.be/);
							isVimeo = -1 !== data.model.src.indexOf('vimeo');
							}

							if ( settings.contentWidth && data.model.width >= settings.contentWidth ) {
							w = settings.contentWidth;
							} else {
							w = data.model.width;
							}

							if ( w !== data.model.width ) {
							h = Math.ceil( ( data.model.height * w ) / data.model.width );
							} else {
							h = data.model.height;
							}

							if ( w ) {
							w_rule = 'width: ' + w + 'px; ';
							}

							if ( isYouTube ) {
							classes.push( 'youtube-video' );
							}

							if ( isVimeo ) {
							classes.push( 'vimeo-video' );
							}

							#>
							<div style="{{ w_rule }}" class="wp-video">
								<video controls
								       class="wp-video-shortcode {{ classes.join( ' ' ) }}"
								<# if ( w ) { #>width="{{ w }}"<# } #>
										<# if ( h ) { #>height="{{ h }}"<# } #>
												<#
													if ( ! _.isUndefined( data.model.poster ) && data.model.poster ) {
													#> poster="{{ data.model.poster }}"<#
														} #>
														preload="{{ _.isUndefined( data.model.preload ) ? 'metadata' : data.model.preload }}"<#
															if ( ! _.isUndefined( data.model.autoplay ) && data.model.autoplay ) {
															#> autoplay<#
																}
																if ( ! _.isUndefined( data.model.loop ) && data.model.loop ) {
																#> loop<#
																	}
																	#>
																	>
																	<# if ( ! _.isEmpty( data.model.src ) ) {
																		if ( isYouTube ) { #>
																		<source src="{{ data.model.src }}" type="video/youtube" />
																		<# } else if ( isVimeo ) { #>
																			<source src="{{ data.model.src }}" type="video/vimeo" />
																			<# } else { #>
																				<source src="{{ data.model.src }}" type="{{ settings.embedMimes[ data.model.src.split('.').pop() ] }}" />
																				<# }
																					} #>

																					<# if ( data.model.mp4 ) { #>
																						<source src="{{ data.model.mp4 }}" type="{{ settings.embedMimes[ 'mp4' ] }}" />
																						<# } #>
																							<# if ( data.model.m4v ) { #>
																								<source src="{{ data.model.m4v }}" type="{{ settings.embedMimes[ 'm4v' ] }}" />
																								<# } #>
																									<# if ( data.model.webm ) { #>
																										<source src="{{ data.model.webm }}" type="{{ settings.embedMimes[ 'webm' ] }}" />
																										<# } #>
																											<# if ( data.model.ogv ) { #>
																												<source src="{{ data.model.ogv }}" type="{{ settings.embedMimes[ 'ogv' ] }}" />
																												<# } #>
																													<# if ( data.model.flv ) { #>
																														<source src="{{ data.model.flv }}" type="{{ settings.embedMimes[ 'flv' ] }}" />
																														<# } #>
																															{{{ data.model.content }}}
																															</video>
							</div>

							<# if ( ! _.isEmpty( data.model.src ) ) {
								ext = data.model.src.split('.').pop();
								if ( html5types[ ext ] ) {
								delete html5types[ ext ];
								}
								#>
								<label class="setting">
									<span>SRC</span>
									<input type="text" disabled="disabled" data-setting="src" value="{{ data.model.src }}" />
									<button type="button" class="button-link remove-setting">Quitar fuente de vídeo</button>
								</label>
								<# } #>
									<# if ( ! _.isEmpty( data.model.mp4 ) ) {
										if ( ! _.isUndefined( html5types.mp4 ) ) {
										delete html5types.mp4;
										}
										#>
										<label class="setting">
											<span>MP4</span>
											<input type="text" disabled="disabled" data-setting="mp4" value="{{ data.model.mp4 }}" />
											<button type="button" class="button-link remove-setting">Quitar fuente de vídeo</button>
										</label>
										<# } #>
											<# if ( ! _.isEmpty( data.model.m4v ) ) {
												if ( ! _.isUndefined( html5types.m4v ) ) {
												delete html5types.m4v;
												}
												#>
												<label class="setting">
													<span>M4V</span>
													<input type="text" disabled="disabled" data-setting="m4v" value="{{ data.model.m4v }}" />
													<button type="button" class="button-link remove-setting">Quitar fuente de vídeo</button>
												</label>
												<# } #>
													<# if ( ! _.isEmpty( data.model.webm ) ) {
														if ( ! _.isUndefined( html5types.webm ) ) {
														delete html5types.webm;
														}
														#>
														<label class="setting">
															<span>WEBM</span>
															<input type="text" disabled="disabled" data-setting="webm" value="{{ data.model.webm }}" />
															<button type="button" class="button-link remove-setting">Quitar fuente de vídeo</button>
														</label>
														<# } #>
															<# if ( ! _.isEmpty( data.model.ogv ) ) {
																if ( ! _.isUndefined( html5types.ogv ) ) {
																delete html5types.ogv;
																}
																#>
																<label class="setting">
																	<span>OGV</span>
																	<input type="text" disabled="disabled" data-setting="ogv" value="{{ data.model.ogv }}" />
																	<button type="button" class="button-link remove-setting">Quitar fuente de vídeo</button>
																</label>
																<# } #>
																	<# if ( ! _.isEmpty( data.model.flv ) ) {
																		if ( ! _.isUndefined( html5types.flv ) ) {
																		delete html5types.flv;
																		}
																		#>
																		<label class="setting">
																			<span>FLV</span>
																			<input type="text" disabled="disabled" data-setting="flv" value="{{ data.model.flv }}" />
																			<button type="button" class="button-link remove-setting">Quitar fuente de vídeo</button>
																		</label>
																		<# } #>
				</div>

				<# if ( ! _.isEmpty( html5types ) ) { #>
					<div class="setting">
						<span>Añadir fuentes alternativas para mejorar la reproducción en HTML5:</span>
						<div class="button-large">
							<# _.each( html5types, function (mime, type) { #>
								<button class="button add-media-source" data-mime="{{ mime }}">{{ type }}</button>
								<# } ) #>
						</div>
					</div>
					<# } #>

						<# if ( ! _.isEmpty( data.model.poster ) ) { #>
							<label class="setting">
								<span>Imagen de poster</span>
								<input type="text" disabled="disabled" data-setting="poster" value="{{ data.model.poster }}" />
								<button type="button" class="button-link remove-setting">Quitar imagen de cartel</button>
							</label>
							<# } #>
								<div class="setting preload">
									<span>Precarga</span>
									<div class="button-group button-large" data-setting="preload">
										<button class="button" value="auto">Automático</button>
										<button class="button" value="metadata">Metadatos</button>
										<button class="button active" value="none">Ninguna</button>
									</div>
								</div>

								<label class="setting checkbox-setting autoplay">
									<input type="checkbox" data-setting="autoplay" />
									<span>Reproducción automática</span>
								</label>

								<label class="setting checkbox-setting">
									<input type="checkbox" data-setting="loop" />
									<span>Repetir</span>
								</label>

								<label class="setting" data-setting="content">
									<span>Pistas (subtítulos, leyendas, descripciones, capítulos o metadatos)</span>
									<#
										var content = '';
										if ( ! _.isEmpty( data.model.content ) ) {
										var tracks = jQuery( data.model.content ).filter( 'track' );
										_.each( tracks.toArray(), function (track) {
										content += track.outerHTML; #>
										<p>
											<input class="content-track" type="text" value="{{ track.outerHTML }}" />
											<button type="button" class="button-link remove-setting remove-track">Eliminar pista de vídeo</button>
										</p>
										<# } ); #>
											<# } else { #>
												<em>No hay subtítulos asociados.</em>
												<# } #>
													<textarea class="hidden content-setting">{{ content }}</textarea>
								</label>
			</div>
		</div>
</script>

<script type="text/html" id="tmpl-editor-gallery">
	<# if ( data.attachments.length ) { #>
		<div class="gallery gallery-columns-{{ data.columns }}">
			<# _.each( data.attachments, function( attachment, index ) { #>
				<dl class="gallery-item">
					<dt class="gallery-icon">
						<# if ( attachment.thumbnail ) { #>
							<img src="{{ attachment.thumbnail.url }}" width="{{ attachment.thumbnail.width }}" height="{{ attachment.thumbnail.height }}" alt="" />
							<# } else { #>
								<img src="{{ attachment.url }}" alt="" />
								<# } #>
					</dt>
					<# if ( attachment.caption ) { #>
						<dd class="wp-caption-text gallery-caption">
							{{{ data.verifyHTML( attachment.caption ) }}}
						</dd>
						<# } #>
				</dl>
				<# if ( index % data.columns === data.columns - 1 ) { #>
					<br style="clear: both;">
					<# } #>
						<# } ); #>
		</div>
		<# } else { #>
			<div class="wpview-error">
				<div class="dashicons dashicons-format-gallery"></div><p>No se han encontrado elementos.</p>
			</div>
			<# } #>
</script>

<script type="text/html" id="tmpl-crop-content">
	<img class="crop-image" src="{{ data.url }}" alt="Previsualización de área de recorte de la imagen. Requiere hace algo con el ratón.">
	<div class="upload-errors"></div>
</script>

<script type="text/html" id="tmpl-site-icon-preview">
	<h2>Vista previa</h2>
	<strong aria-hidden="true">Como un icono del navegador</strong>
	<div class="favicon-preview">
		<img src="https://www.cifimad.es/wp-admin/images/browser.png" class="browser-preview" width="182" height="" alt="" />

		<div class="favicon">
			<img id="preview-favicon" src="{{ data.url }}" alt="Vista previa como un icono del navegador"/>
		</div>
		<span class="browser-title" aria-hidden="true">CifiMad</span>
	</div>

	<strong aria-hidden="true">Como un icono de aplicación</strong>
	<div class="app-icon-preview">
		<img id="preview-app-icon" src="{{ data.url }}" alt="Vista previa como un icono de aplicación"/>
	</div>
</script>

<script id="tmpl-rwmb-media-item" type="text/html">
	<input type="hidden" name="{{{ data.fieldName }}}" value="{{{ data.id }}}" class="rwmb-media-input">
	<div class="rwmb-media-preview">
		<div class="rwmb-media-content">
			<div class="centered">
				<# if ( 'image' === data.type && data.sizes ) { #>
					<# if ( data.sizes.thumbnail ) { #>
						<img src="{{{ data.sizes.thumbnail.url }}}">
						<# } else { #>
							<img src="{{{ data.sizes.full.url }}}">
							<# } #>
								<# } else { #>
									<# if ( data.image && data.image.src && data.image.src !== data.icon ) { #>
										<img src="{{ data.image.src }}" />
										<# } else { #>
											<img src="{{ data.icon }}" />
											<# } #>
												<# } #>
			</div>
		</div>
	</div>
	<div class="rwmb-media-info">
		<h4>
			<a href="{{{ data.url }}}" target="_blank" title="{{{ i18nRwmbMedia.view }}}">
				<# if( data.title ) { #> {{{ data.title }}}
					<# } else { #> {{{ i18nRwmbMedia.noTitle }}}
						<# } #>
			</a>
		</h4>
		<p>{{{ data.mime }}}</p>
		<p>
			<a class="rwmb-edit-media" title="{{{ i18nRwmbMedia.edit }}}" href="{{{ data.editLink }}}" target="_blank">
				<span class="dashicons dashicons-edit"></span>{{{ i18nRwmbMedia.edit }}}
			</a>
			<a href="#" class="rwmb-remove-media" title="{{{ i18nRwmbMedia.remove }}}">
				<span class="dashicons dashicons-no-alt"></span>{{{ i18nRwmbMedia.remove }}}
			</a>
		</p>
	</div>
</script>

<script id="tmpl-rwmb-media-status" type="text/html">
	<# if ( data.maxFiles > 0 ) { #>
		{{{ data.length }}}/{{{ data.maxFiles }}}
		<# if ( 1 < data.maxFiles ) { #>  {{{ i18nRwmbMedia.multiple }}} <# } else {#> {{{ i18nRwmbMedia.single }}} <# } #>
				<# } #>
</script>
<script id="tmpl-rwmb-image-item" type="text/html">
	<input type="hidden" name="{{{ data.fieldName }}}" value="{{{ data.id }}}" class="rwmb-media-input">
	<div class="rwmb-media-preview">
		<div class="rwmb-media-content">
			<div class="centered">
				<# if ( 'image' === data.type && data.sizes ) { #>
					<# if ( data.sizes.thumbnail ) { #>
						<img src="{{{ data.sizes.thumbnail.url }}}">
						<# } else { #>
							<img src="{{{ data.sizes.full.url }}}">
							<# } #>
								<# } else { #>
									<# if ( data.image && data.image.src && data.image.src !== data.icon ) { #>
										<img src="{{ data.image.src }}" />
										<# } else { #>
											<img src="{{ data.icon }}" />
											<# } #>
												<# } #>
			</div>
		</div>
	</div>
	<div class="rwmb-overlay"></div>
	<div class="rwmb-media-bar">
		<a class="rwmb-edit-media" title="{{{ i18nRwmbMedia.edit }}}" href="{{{ data.editLink }}}" target="_blank">
			<span class="dashicons dashicons-edit"></span>
		</a>
		<a href="#" class="rwmb-remove-media" title="{{{ i18nRwmbMedia.remove }}}">
			<span class="dashicons dashicons-no-alt"></span>
		</a>
	</div>
</script>
<script type='text/javascript'>
	/* <![CDATA[ */
	var wpcf7 = {"apiSettings":{"root":"https:\/\/www.cifimad.es\/wp-json\/contact-form-7\/v1","namespace":"contact-form-7\/v1"},"recaptcha":{"messages":{"empty":"Por favor, prueba que no eres un robot."}}};
	/* ]]> */
</script>
<script type='text/javascript' src='https://www.cifimad.es/wp-content/plugins/contact-form-7/includes/js/scripts.js?ver=4.9'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-content/plugins/responsive-table-for-woocommerce/public/js/bootstrap.min.js?ver=4.8.7'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js?ver=2.70'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min.js?ver=2.1.4'></script>
<script type='text/javascript'>
	/* <![CDATA[ */
	var woocommerce_params = {"ajax_url":"\/wp-admin\/admin-ajax.php","wc_ajax_url":"https:\/\/www.cifimad.es\/?wc-ajax=%%endpoint%%"};
	/* ]]> */
</script>
<script type='text/javascript' src='https://www.cifimad.es/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js?ver=3.2.3'></script>
<script type='text/javascript'>
	/* <![CDATA[ */
	var wc_cart_fragments_params = {"ajax_url":"\/wp-admin\/admin-ajax.php","wc_ajax_url":"https:\/\/www.cifimad.es\/?wc-ajax=%%endpoint%%","fragment_name":"wc_fragments_92f0ff2f9c7ff417c6ef2afda7e8f894"};
	/* ]]> */
</script>
<script type='text/javascript' src='https://www.cifimad.es/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js?ver=3.2.3'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-content/themes/eventum/js/jquery.countdown.min.js?ver=4.8.7'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-content/themes/eventum/js/jquery.magnific-popup.min.js?ver=4.8.7'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-content/themes/eventum/js/loopcounter.js?ver=4.8.7'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-content/themes/eventum/js/gmaps.js?ver=4.8.7'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-content/themes/eventum/js/queryloader2.min.js?ver=4.8.7'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/underscore.min.js?ver=1.8.3'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/shortcode.min.js?ver=4.8.7'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/backbone.min.js?ver=1.2.3'></script>
<script type='text/javascript'>
	/* <![CDATA[ */
	var _wpUtilSettings = {"ajax":{"url":"\/wp-admin\/admin-ajax.php"}};
	/* ]]> */
</script>
<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/wp-util.min.js?ver=4.8.7'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/wp-backbone.min.js?ver=4.8.7'></script>
<script type='text/javascript'>
	/* <![CDATA[ */
	var _wpMediaModelsL10n = {"settings":{"ajaxurl":"\/wp-admin\/admin-ajax.php","post":{"id":0}}};
	/* ]]> */
</script>
<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/media-models.min.js?ver=4.8.7'></script>
<script type='text/javascript'>
	/* <![CDATA[ */
	var pluploadL10n = {"queue_limit_exceeded":"Has intentado poner en cola demasiados archivos.","file_exceeds_size_limit":"El tama\u00f1o del archivo %s excede el tama\u00f1o permitido en este sitio.","zero_byte_file":"Este archivo est\u00e1 vacio. Por favor, prueba con otro.","invalid_filetype":"Lo siento, este tipo de archivo no est\u00e1 permitido por motivos de seguridad.","not_an_image":"Este archivo no es una imagen. Por favor, prueba con otro.","image_memory_exceeded":"Memoria excedida. Por favor, prueba con otro archivo m\u00e1s peque\u00f1o.","image_dimensions_exceeded":"Supera el tama\u00f1o permitido. Por favor, prueba con otro.","default_error":"Ha habido un error en la subida. Por favor int\u00e9ntalo m\u00e1s tarde.","missing_upload_url":"Ha habido un problema con la configuraci\u00f3n. Por favor, contacta con el  administrador del servidor.","upload_limit_exceeded":"Solo puedes subir 1 archivo.","http_error":"Error HTTP.","upload_failed":"Fall\u00f3 la subida.","big_upload_failed":"Por favor, intenta subir este archivo a trav\u00e9s del %1$snavegador%2$s.","big_upload_queued":"%s excede el tama\u00f1o m\u00e1ximo de subida del cargador de m\u00faltiples archivos del navegador.","io_error":"Error de entrada\/salida.","security_error":"Error de seguridad.","file_cancelled":"Archivo cancelado.","upload_stopped":"Subida detenida.","dismiss":"Descartar","crunching":"Calculando\u2026","deleted":"movidos a la papelera.","error_uploading":"Ha habido un error al subir \u201c%s\u201d"};
	var _wpPluploadSettings = {"defaults":{"runtimes":"html5,flash,silverlight,html4","file_data_name":"async-upload","url":"\/wp-admin\/async-upload.php","flash_swf_url":"https:\/\/www.cifimad.es\/wp-includes\/js\/plupload\/plupload.flash.swf","silverlight_xap_url":"https:\/\/www.cifimad.es\/wp-includes\/js\/plupload\/plupload.silverlight.xap","filters":{"max_file_size":"33554432b","mime_types":[{"extensions":"323,acx,ai,aif,aifc,aiff,asf,asr,asx,au,avi,axs,bas,bcpio,bin,bmp,c,cat,cdf,cer,class,clp,cmx,cod,cpio,crd,crl,crt,csh,css,dcr,der,dir,dll,dms,doc,dot,dvi,dxr,eps,etx,evy,exe,fif,flr,gif,gtar,gz,h,hdf,hlp,hqx,hta,htc,htm,html,htt,ico,ief,iii,ins,isp,jfif,jpe,jpeg,jpg,png,js,latex,lha,lsf,lsx,lzh,m13,m14,m3u,man,mdb,me,mht,mhtml,mid,mny,mov,movie,mp2,mp4,mp3,mpa,mpe,mpeg,mpg,mpp,mpv2,ms,mvb,nws,oda,p10,p12,p7b,p7c,p7m,p7r,p7s,pbm,pdf,pfx,pgm,pko,pma,pmc,pml,pmr,pmw,pnm,pot,ppm,pps,ppt,prf,ps,pub,qt,ra,ram,ras,rgb,rmi,roff,rtf,rtx,scd,sct,setpay,setreg,sh,shar,sit,snd,spc,spl,src,sst,stl,stm,svg,sv4cpio,sv4crc,t,tar,tcl,tex,texi,texinfo,tgz,tif,tiff,tr,trm,tsv,txt,uls,ustar,vcf,vrml,wav,wcm,wdb,wks,wmf,wps,wri,wrl,wrz,xaf,xbm,xla,xlc,xlm,xls,xlsx,xlt,xlw,xof,xpm,xwd,z,zip,redux"}]},"multipart_params":{"action":"upload-attachment","_wpnonce":"fb8c6baa36"}},"browser":{"mobile":false,"supported":true},"limitExceeded":false};
	/* ]]> */
</script>
<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/plupload/wp-plupload.min.js?ver=4.8.7'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/jquery/ui/core.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/jquery/ui/widget.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/jquery/ui/mouse.min.js?ver=1.11.4'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/jquery/ui/sortable.min.js?ver=1.11.4'></script>
<script type='text/javascript'>
	/* <![CDATA[ */
	var mejsL10n = {"language":"es-ES","strings":{"Close":"Cerrar","Fullscreen":"Pantalla completa","Turn off Fullscreen":"Salir de pantalla completa","Go Fullscreen":"Ver en pantalla completa","Download File":"Descargar archivo","Download Video":"Descargar v\u00eddeo","Play":"Reproducir","Pause":"Pausa","Captions\/Subtitles":"Pies de foto \/ Subt\u00edtulos","None":"Ninguno","Time Slider":"Control de tiempo","Skip back %1 seconds":"Retroceder %1 segundos","Video Player":"Reproductor de v\u00eddeo","Audio Player":"Reproductor de audio","Volume Slider":"Control de volumen","Mute Toggle":"Desactivar sonido","Unmute":"Activar sonido","Mute":"Silenciar","Use Up\/Down Arrow keys to increase or decrease volume.":"Utiliza las teclas de flecha arriba\/abajo para aumentar o disminuir el volumen.","Use Left\/Right Arrow keys to advance one second, Up\/Down arrows to advance ten seconds.":"Usa las teclas de direcci\u00f3n izquierda\/derecha para avanzar un segundo, y las flechas arriba\/abajo para avanzar diez segundos."}};
	var _wpmejsSettings = {"pluginPath":"\/wp-includes\/js\/mediaelement\/"};
	/* ]]> */
</script>
<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/mediaelement/mediaelement-and-player.min.js?ver=2.22.0'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/mediaelement/wp-mediaelement.min.js?ver=4.8.7'></script>
<script type='text/javascript'>
	/* <![CDATA[ */
	var _wpMediaViewsL10n = {"url":"URL","addMedia":"A\u00f1adir objeto","search":"Buscar","select":"Elegir","cancel":"Cancelar","update":"Actualizar","replace":"Reemplazar","remove":"Eliminar","back":"Volver","selected":"%d seleccionados","dragInfo":"Arrastra y suelta para reordenar archivos multimedia.","uploadFilesTitle":"Subir archivos","uploadImagesTitle":"Subir im\u00e1genes","mediaLibraryTitle":"Biblioteca de medios","insertMediaTitle":"Insertar medios","createNewGallery":"Crear una nueva galer\u00eda","createNewPlaylist":"Crear una nueva lista de reproducci\u00f3n","createNewVideoPlaylist":"Crear una nueva lista de reproducci\u00f3n de v\u00eddeos","returnToLibrary":"\u2190 Volver a la biblioteca","allMediaItems":"Todos los medios","allDates":"Todas las fechas","noItemsFound":"No se han encontrado elementos.","insertIntoPost":"Insertar en la entrada","unattached":"Sin adjuntar","trash":"Papelera","uploadedToThisPost":"Subido a esta entrada","warnDelete":"Est\u00e1s a punto de borrar permanentemente este elemento de tu sitio.\nEsta acci\u00f3n es irreversible.\n'Cancelar' para parar, 'Aceptar' para borrar.","warnBulkDelete":"Est\u00e1s a punto de borrar permanentemente estos elementos de tu sitio.\nEsta acci\u00f3n es irreversible.\n'Cancelar' para parar, 'Aceptar' para borrar.","warnBulkTrash":"Est\u00e1s a punto de enviar a la papelera estos elementos.\n  'Cancelar' para parar, 'OK' para borrarlos.","bulkSelect":"Selecci\u00f3n m\u00faltiple","cancelSelection":"Cancelar selecci\u00f3n","trashSelected":"\"Enviar a la papelera\" seleccionado","untrashSelected":"\"Sacar de la papelera\" seleccionado","deleteSelected":"Borrar selecci\u00f3n","deletePermanently":"Borrar permanentemente","apply":"Aplicar","filterByDate":"Filtrar por fecha","filterByType":"Filtrar por tipo","searchMediaLabel":"Buscar medios","searchMediaPlaceholder":"Busca medios...","noMedia":"No se encontraron archivos multimedia.","attachmentDetails":"Detalles de adjuntos","insertFromUrlTitle":"Insertar desde URL","setFeaturedImageTitle":"Imagen destacada","setFeaturedImage":"Establecer imagen destacada","createGalleryTitle":"Crear galer\u00eda","editGalleryTitle":"Editar galer\u00eda","cancelGalleryTitle":"\u2190 Cancelar galer\u00eda","insertGallery":"Inserta galer\u00eda","updateGallery":"Actualizar galer\u00eda","addToGallery":"A\u00f1adir a la galer\u00eda","addToGalleryTitle":"A\u00f1adir a la Galer\u00eda","reverseOrder":"Orden inverso","imageDetailsTitle":"Detalles de la imagen","imageReplaceTitle":"Reemplazar imagen","imageDetailsCancel":"Cancela la edici\u00f3n","editImage":"Editar imagen","chooseImage":"Elegir imagen","selectAndCrop":"Selecciona y recorta","skipCropping":"No recortar","cropImage":"Recortar imagen","cropYourImage":"Recorta tu imagen","cropping":"Recortando\u2026","suggestedDimensions":"Dimensiones de imagen sugeridas: %1$s por %2$s p\u00edxeles.","cropError":"Se ha producido un error recortando la imagen.","audioDetailsTitle":"Detalles del audio","audioReplaceTitle":"Reemplazar audio","audioAddSourceTitle":"A\u00f1adir origen del audio","audioDetailsCancel":"Cancela la edici\u00f3n","videoDetailsTitle":"Detalles del v\u00eddeo","videoReplaceTitle":"Reemplazar v\u00eddeo","videoAddSourceTitle":"A\u00f1adir fuente de v\u00eddeo","videoDetailsCancel":"Cancela la edici\u00f3n","videoSelectPosterImageTitle":"Elegir imagen de poster","videoAddTrackTitle":"A\u00f1adir subt\u00edtulos","playlistDragInfo":"Arrastrar y soltar para reordenar pistas.","createPlaylistTitle":"Crear lista de reproducci\u00f3n de audios","editPlaylistTitle":"Editar lista de reproducci\u00f3n de audio","cancelPlaylistTitle":"\u2190 Cancelar lista de reproducci\u00f3n de audio","insertPlaylist":"Insertar lista de reproducci\u00f3n de audio","updatePlaylist":"Actualizar lista de reproducci\u00f3n de audio","addToPlaylist":"A\u00f1adir a la lista de reproducci\u00f3n de audio","addToPlaylistTitle":"A\u00f1adir a la lista de reproducci\u00f3n de audio","videoPlaylistDragInfo":"Arrastrar y soltar para reordenar v\u00eddeos.","createVideoPlaylistTitle":"Crear lista de reproducci\u00f3n de v\u00eddeos","editVideoPlaylistTitle":"Editar lista de reproducci\u00f3n de v\u00eddeo","cancelVideoPlaylistTitle":"\u2190 Cancelar lista de reproducci\u00f3n de v\u00eddeos","insertVideoPlaylist":"Insertar lista de reproducci\u00f3n de v\u00eddeo","updateVideoPlaylist":"Actualizar lista de reproducci\u00f3n de v\u00eddeos","addToVideoPlaylist":"A\u00f1adir a lista de reproducci\u00f3n de v\u00eddeos","addToVideoPlaylistTitle":"A\u00f1adir a lista de reproducci\u00f3n de v\u00eddeo","iconPicker":{"frameTitle":"Icon Picker","allFilter":"All","selectIcon":"Select Icon"},"settings":{"tabs":[],"tabUrl":"https:\/\/www.cifimad.es\/wp-admin\/media-upload.php?chromeless=1","mimeTypes":{"image":"Im\u00e1genes","audio":"Audio","video":"V\u00eddeo"},"captions":true,"nonce":{"sendToEditor":"6aa872d5e6","wpRestApi":"36a83a97d4"},"post":{"id":0},"defaultProps":{"link":"none","align":"","size":""},"attachmentCounts":{"audio":1,"video":1},"oEmbedProxyUrl":"https:\/\/www.cifimad.es\/wp-json\/oembed\/1.0\/proxy","embedExts":["mp3","ogg","m4a","wav","mp4","m4v","webm","ogv","flv"],"embedMimes":{"mp3":"audio\/mpeg","wav":"audio\/x-wav","mp4":"video\/mp4"},"contentWidth":null,"months":[{"year":"2018","month":"11","text":"noviembre 2018"},{"year":"2018","month":"8","text":"agosto 2018"},{"year":"2018","month":"7","text":"julio 2018"},{"year":"2018","month":"3","text":"marzo 2018"},{"year":"2018","month":"2","text":"febrero 2018"},{"year":"2018","month":"1","text":"enero 2018"},{"year":"2017","month":"12","text":"diciembre 2017"},{"year":"2017","month":"11","text":"noviembre 2017"},{"year":"2017","month":"10","text":"octubre 2017"},{"year":"2017","month":"9","text":"septiembre 2017"},{"year":"2016","month":"9","text":"septiembre 2016"},{"year":"2016","month":"1","text":"enero 2016"},{"year":"2015","month":"10","text":"octubre 2015"},{"year":"2015","month":"9","text":"septiembre 2015"}],"mediaTrash":0}};
	/* ]]> */
</script>
<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/media-views.min.js?ver=4.8.7'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/media-editor.min.js?ver=4.8.7'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/media-audiovideo.min.js?ver=4.8.7'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-content/themes/eventum/js/main.js?ver=4.8.7'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-includes/js/wp-embed.min.js?ver=4.8.7'></script>
<script type='text/javascript' src='https://www.cifimad.es/wp-content/plugins/js_composer/assets/js/dist/js_composer_front.min.js?ver=5.1.1'></script>
<!-- WooCommerce JavaScript -->
<script type="text/javascript">
	jQuery(function($) {

		jQuery( function( $ ) {
			var ppec_mark_fields      = '#woocommerce_ppec_paypal_title, #woocommerce_ppec_paypal_description';
			var ppec_live_fields      = '#woocommerce_ppec_paypal_api_username, #woocommerce_ppec_paypal_api_password, #woocommerce_ppec_paypal_api_signature, #woocommerce_ppec_paypal_api_certificate, #woocommerce_ppec_paypal_api_subject';
			var ppec_sandbox_fields   = '#woocommerce_ppec_paypal_sandbox_api_username, #woocommerce_ppec_paypal_sandbox_api_password, #woocommerce_ppec_paypal_sandbox_api_signature, #woocommerce_ppec_paypal_sandbox_api_certificate, #woocommerce_ppec_paypal_sandbox_api_subject';

			var enable_toggle         = $( 'a.ppec-toggle-settings' ).length > 0;
			var enable_sandbox_toggle = $( 'a.ppec-toggle-sandbox-settings' ).length > 0;

			$( '#woocommerce_ppec_paypal_environment' ).change(function(){
				$( ppec_sandbox_fields + ',' + ppec_live_fields ).closest( 'tr' ).hide();

				if ( 'live' === $( this ).val() ) {
					$( '#woocommerce_ppec_paypal_api_credentials, #woocommerce_ppec_paypal_api_credentials + p' ).show();
					$( '#woocommerce_ppec_paypal_sandbox_api_credentials, #woocommerce_ppec_paypal_sandbox_api_credentials + p' ).hide();

					if ( ! enable_toggle ) {
						$( ppec_live_fields ).closest( 'tr' ).show();
					}
				} else {
					$( '#woocommerce_ppec_paypal_api_credentials, #woocommerce_ppec_paypal_api_credentials + p' ).hide();
					$( '#woocommerce_ppec_paypal_sandbox_api_credentials, #woocommerce_ppec_paypal_sandbox_api_credentials + p' ).show();

					if ( ! enable_sandbox_toggle ) {
						$( ppec_sandbox_fields ).closest( 'tr' ).show();
					}
				}
			}).change();

			$( '#woocommerce_ppec_paypal_mark_enabled' ).change(function(){
				if ( $( this ).is( ':checked' ) ) {
					$( ppec_mark_fields ).closest( 'tr' ).show();
				} else {
					$( ppec_mark_fields ).closest( 'tr' ).hide();
				}
			}).change();

			$( '#woocommerce_ppec_paypal_paymentaction' ).change(function(){
				if ( 'sale' === $( this ).val() ) {
					$( '#woocommerce_ppec_paypal_instant_payments' ).closest( 'tr' ).show();
				} else {
					$( '#woocommerce_ppec_paypal_instant_payments' ).closest( 'tr' ).hide();
				}
			}).change();

			if ( enable_toggle ) {
				$( document ).on( 'click', '.ppec-toggle-settings', function( e ) {
					$( ppec_live_fields ).closest( 'tr' ).toggle( 'fast' );
					e.preventDefault();
				} );
			}
			if ( enable_sandbox_toggle ) {
				$( document ).on( 'click', '.ppec-toggle-sandbox-settings', function( e ) {
					$( ppec_sandbox_fields ).closest( 'tr' ).toggle( 'fast' );
					e.preventDefault();
				} );
			}
		});

	});
</script>
<script type="text/javascript">
</body>
</html>

