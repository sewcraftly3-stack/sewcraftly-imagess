/**
 * SewCraftly: German and French interface.
 * On /de/ and /fr/ pages, translates the theme, sidebar, footer, home hero and snippet texts,
 * and points internal links (categories, patterns, home) to the same language.
 * Post content is translated in the posts themselves; this only covers the interface around it.
 */
if ( ! defined( 'SC_I18N_LOADED' ) ) {
define( 'SC_I18N_LOADED', true );

function sc_i18n_lang() {
	if ( ! function_exists( 'pll_current_language' ) ) {
		return '';
	}
	$l = pll_current_language();
	return ( 'de' === $l || 'fr' === $l ) ? $l : '';
}

/* Exact texts (text between tags, and placeholder / aria-label / title / alt). English => array( German, French ) */
function sc_i18n_texts() {
	return array(
		// Header, menu, search
		'Skip to content'                 => array( 'Zum Inhalt springen', 'Aller au contenu' ),
		'Search patterns'                 => array( 'Schnittmuster suchen', 'Rechercher un patron' ),
		'Search patterns…'                => array( 'Schnittmuster suchen…', 'Rechercher un patron…' ),
		'Search patterns and tutorials…'  => array( 'Schnittmuster & Anleitungen suchen…', 'Rechercher patrons et tutoriels…' ),
		'Dress, shorts, top…'             => array( 'Kleid, Shorts, Top…', 'Robe, short, haut…' ),
		'Search'                          => array( 'Suchen', 'Rechercher' ),
		'Menu'                            => array( 'Menü', 'Menu' ),
		'Open menu'                       => array( 'Menü öffnen', 'Ouvrir le menu' ),
		'Close menu'                      => array( 'Menü schließen', 'Fermer le menu' ),
		'Show Menu'                       => array( 'Menü anzeigen', 'Afficher le menu' ),
		'Close'                           => array( 'Schließen', 'Fermer' ),
		'Back To Top'                     => array( 'Nach oben', 'Haut de page' ),
		'View all →'                      => array( 'Alle ansehen →', 'Tout voir →' ),
		// Post meta, archives, pagination
		'Posted on'                       => array( 'Veröffentlicht am', 'Publié le' ),
		'Posted in'                       => array( 'Kategorie', 'Catégorie' ),
		'Author'                          => array( 'Autor', 'Auteur' ),
		'Tagged:'                         => array( 'Schlagwörter:', 'Mots-clés :' ),
		'Leave a Reply'                   => array( 'Schreibe einen Kommentar', 'Laisser un commentaire' ),
		'Search Results for:'             => array( 'Suchergebnisse für:', 'Résultats de recherche pour :' ),
		'All posts in'                    => array( 'Alle Beiträge in', 'Tous les articles dans' ),
		'Page'                            => array( 'Seite', 'Page' ),
		'Next →'                          => array( 'Weiter →', 'Suivant →' ),
		'← Previous'                      => array( '← Zurück', '← Précédent' ),
		// Sidebar
		'Browse patterns'                 => array( 'Schnittmuster entdecken', 'Parcourir les patrons' ),
		'Free sewing patterns, made with love' => array( 'Kostenlose Schnittmuster, mit Liebe gemacht', 'Des patrons gratuits, faits avec amour' ),
		'Hi, welcome!'                    => array( 'Hallo und willkommen!', 'Bonjour et bienvenue !' ),
		'We share free sewing patterns with clear size charts and easy steps, for beginners and seasoned sewists alike. We hope you find your next make here.' => array(
			'Wir teilen kostenlose Schnittmuster mit klaren Größentabellen und einfachen Schritten – für Anfängerinnen genauso wie für erfahrene Näherinnen. Wir hoffen, du findest hier dein nächstes Nähprojekt.',
			'Nous partageons des patrons de couture gratuits, avec des tableaux de tailles clairs et des étapes simples, pour les débutantes comme pour les couturières confirmées. Nous espérons que vous trouverez ici votre prochain projet.',
		),
		'Free PDF patterns'               => array( 'Kostenlose PDF-Schnittmuster', 'Patrons PDF gratuits' ),
		'Clear size charts'               => array( 'Klare Größentabellen', 'Tableaux de tailles clairs' ),
		'Step-by-step instructions'       => array( 'Schritt-für-Schritt-Anleitungen', 'Instructions pas à pas' ),
		'Happy sewing!'                   => array( 'Viel Spaß beim Nähen!', 'Bonne couture !' ),
		'More about us →'                 => array( 'Mehr über uns →', 'En savoir plus sur nous →' ),
		'Buy us a coffee'                 => array( 'Spendier uns einen Kaffee', 'Offrez-nous un café' ),
		'Help us keep every pattern free ♡' => array( 'Hilf uns, alle Schnittmuster kostenlos zu halten ♡', 'Aidez-nous à garder tous nos patrons gratuits ♡' ),
		'Recent Patterns'                 => array( 'Neueste Schnittmuster', 'Derniers patrons' ),
		'Free gift'                       => array( 'Gratis-Geschenk', 'Cadeau offert' ),
		'Sew with confidence from the very first stitch' => array( 'Näh mit Selbstvertrauen – vom ersten Stich an', 'Cousez en confiance dès le premier point' ),
		'Get our'                         => array( 'Hol dir unser', 'Recevez notre' ),
		'Sewist’s Handbook + Sewing Planner' => array( 'Nähhandbuch + Nähplaner', 'guide de couture + planner' ),
		'free: everything we wish we’d known when we started.' => array( 'gratis: alles, was wir am Anfang gern gewusst hätten.', 'gratuit : tout ce que nous aurions aimé savoir à nos débuts.' ),
		'Find your true size in minutes'  => array( 'Finde in wenigen Minuten deine richtige Größe', 'Trouvez votre vraie taille en quelques minutes' ),
		'Quick fixes for the most common fit problems' => array( 'Schnelle Lösungen für die häufigsten Passformprobleme', 'Des solutions rapides aux problèmes d’ajustement courants' ),
		'The right fabric for every pattern' => array( 'Der richtige Stoff für jedes Schnittmuster', 'Le bon tissu pour chaque patron' ),
		'A printable planner to organise your makes' => array( 'Ein Planer zum Ausdrucken für deine Nähprojekte', 'Un planner à imprimer pour organiser vos projets' ),
		'Free gift: our'                  => array( 'Gratis-Geschenk: unser', 'Cadeau offert : notre' ),
		'20-page Sewist’s Handbook + Sewing Planner' => array( '20-seitiges Nähhandbuch + Nähplaner', 'guide de couture de 20 pages + planner' ),
		', with size chart, fit fixes, fabric guide and printable planner. Enter your email and it’s yours.' => array(
			', mit Größentabelle, Passform-Tipps, Stoffratgeber und Planer zum Ausdrucken. Gib deine E-Mail-Adresse ein und es gehört dir.',
			', avec tableau des tailles, retouches d’ajustement, guide des tissus et planner à imprimer. Entrez votre e-mail et il est à vous.',
		),
		'Email address'                   => array( 'E-Mail-Adresse', 'Adresse e-mail' ),
		'Your email address'              => array( 'Deine E-Mail-Adresse', 'Votre adresse e-mail' ),
		'Send me the handbook'            => array( 'Handbuch zuschicken', 'Recevoir le guide' ),
		'No spam, unsubscribe anytime. By subscribing you agree to our' => array( 'Kein Spam, jederzeit abbestellbar. Mit der Anmeldung akzeptierst du unsere', 'Pas de spam, désinscription à tout moment. En vous inscrivant, vous acceptez notre' ),
		'Privacy Policy'                  => array( 'Datenschutzerklärung', 'politique de confidentialité' ),
		// Footer
		'Free PDF sewing patterns with size charts and step-by-step instructions.' => array( 'Kostenlose PDF-Schnittmuster mit Größentabellen und Schritt-für-Schritt-Anleitungen.', 'Patrons de couture PDF gratuits, avec tableaux de tailles et instructions pas à pas.' ),
		'About Us'                        => array( 'Über uns', 'À propos' ),
		'Terms of Service'                => array( 'Nutzungsbedingungen', 'Conditions d’utilisation' ),
		'Disclaimer'                      => array( 'Haftungsausschluss', 'Avertissement' ),
		'Help'                            => array( 'Hilfe', 'Aide' ),
		'Contact Us'                      => array( 'Kontakt', 'Contact' ),
		'Privacy & Cookies'               => array( 'Datenschutz & Cookies', 'Confidentialité & cookies' ),
		'Sewing Tutorials'                => array( 'Nähanleitungen', 'Tutoriels couture' ),
		// Cookie banner
		'Customize'                       => array( 'Anpassen', 'Personnaliser' ),
		'Reject All'                      => array( 'Alle ablehnen', 'Tout refuser' ),
		'Accept All'                      => array( 'Alle akzeptieren', 'Tout accepter' ),
		'Save My Preferences'             => array( 'Einstellungen speichern', 'Enregistrer mes préférences' ),
		'Cookie Consent'                  => array( 'Cookie-Einstellungen', 'Gestion des cookies' ),
		// Home hero slider
		'Featured'                        => array( 'Highlights', 'À la une' ),
		'Previous slide'                  => array( 'Vorherige Folie', 'Diapositive précédente' ),
		'Next slide'                      => array( 'Nächste Folie', 'Diapositive suivante' ),
		'100% free · PDF'                 => array( '100 % kostenlos · PDF', '100 % gratuit · PDF' ),
		'Sew Something'                   => array( 'Näh dir etwas,', 'Cousez des pièces' ),
		'You\'ll Love'                    => array( 'das du liebst', 'que vous adorerez' ),
		'Discover our newest free sewing patterns' => array( 'Entdecke unsere neuesten kostenlosen Schnittmuster', 'Découvrez nos nouveaux patrons de couture gratuits' ),
		'· Sizes XXS–4XL · A4 & US Letter' => array( '· Größen XXS–4XL · A4 & US Letter', '· Tailles XXS–4XL · A4 & US Letter' ),
		'Free tutorials'                  => array( 'Kostenlose Anleitungen', 'Tutoriels gratuits' ),
		'Learn to Sew,'                   => array( 'Nähen lernen,', 'Apprenez à coudre,' ),
		'Step by Step'                    => array( 'Schritt für Schritt', 'pas à pas' ),
		'Illustrated guides'              => array( 'Illustrierte Anleitungen', 'Des guides illustrés' ),
		'for beginners: measurements, fabric, zippers and more' => array( 'für Anfängerinnen: Maße, Stoffe, Reißverschlüsse und mehr', 'pour débutantes : mesures, tissus, fermetures éclair et plus' ),
		'Start learning'                  => array( 'Jetzt lernen', 'Commencer' ),
		'New for autumn'                  => array( 'Neu im Herbst', 'Nouveau cet automne' ),
		'Jackets & Coats'                 => array( 'Jacken & Mäntel', 'Vestes & manteaux' ),
		'to Sew'                          => array( 'zum Selbernähen', 'à coudre' ),
		'Free patterns'                   => array( 'Kostenlose Schnittmuster', 'Des patrons gratuits' ),
		'for cozy layers, from blazers to hooded coats' => array( 'für gemütliche Lagen, vom Blazer bis zum Kapuzenmantel', 'pour des tenues douillettes, du blazer au manteau à capuche' ),
		'See jackets'                     => array( 'Jacken ansehen', 'Voir les vestes' ),
		'Woman wearing a handmade terracotta puff sleeve midi dress sewn from a free PDF sewing pattern' => array( 'Frau in einem selbstgenähten terrakottafarbenen Midikleid mit Puffärmeln nach einem kostenlosen PDF-Schnittmuster', 'Femme portant une robe midi terracotta à manches bouffantes cousue avec un patron PDF gratuit' ),
		'Hands placing a printed PDF sewing pattern on fabric with tape measure, scissors and pins' => array( 'Hände legen ein ausgedrucktes PDF-Schnittmuster mit Maßband, Schere und Stecknadeln auf Stoff', 'Mains posant un patron PDF imprimé sur du tissu avec mètre ruban, ciseaux et épingles' ),
		'Woman in a handmade brown corduroy jacket sewn from a free jacket sewing pattern in an autumn park' => array( 'Frau in einer selbstgenähten braunen Cordjacke nach einem kostenlosen Jacken-Schnittmuster im Herbstpark', 'Femme dans une veste en velours côtelé marron cousue avec un patron de veste gratuit, dans un parc en automne' ),
		// Home category band
		'Shop by category'                => array( 'Nach Kategorie stöbern', 'Parcourir par catégorie' ),
		'Find your next'                  => array( 'Finde dein nächstes', 'Trouvez votre prochain' ),
		'make'                            => array( 'Nähprojekt', 'projet couture' ),
		'Dresses'                         => array( 'Kleider', 'Robes' ),
		'Tops'                            => array( 'Oberteile', 'Hauts' ),
		'Pants'                           => array( 'Hosen', 'Pantalons' ),
		'Skirts'                          => array( 'Röcke', 'Jupes' ),
		'More patterns'                   => array( 'Mehr Schnittmuster', 'Plus de patrons' ),
		'Tutorials'                       => array( 'Anleitungen', 'Tutoriels' ),
		'Dresses sewing patterns'         => array( 'Schnittmuster für Kleider', 'Patrons de robes' ),
		'Tops sewing patterns'            => array( 'Schnittmuster für Oberteile', 'Patrons de hauts' ),
		'Pants sewing patterns'           => array( 'Schnittmuster für Hosen', 'Patrons de pantalons' ),
		'Skirts sewing patterns'          => array( 'Schnittmuster für Röcke', 'Patrons de jupes' ),
		'Shorts sewing patterns'          => array( 'Schnittmuster für Shorts', 'Patrons de shorts' ),
		'Jackets & Coats sewing patterns' => array( 'Schnittmuster für Jacken & Mäntel', 'Patrons de vestes & manteaux' ),
		// Newsletter band, popup, mobile gift bar
		'Free 20-page printable'          => array( 'Gratis · 20 Seiten zum Ausdrucken', 'Offert · 20 pages à imprimer' ),
		'The Sewist’s Handbook'           => array( 'Das Nähhandbuch', 'Le guide de couture' ),
		'+ Sewing Planner'                => array( '+ Nähplaner', '+ planner couture' ),
		'Size chart, fit fixes, fabric & yardage guides, machine settings and a 10-page printable planner. Free when you join the SewCraftly newsletter, plus every new free pattern in your inbox.' => array(
			'Größentabelle, Passform-Tipps, Stoff- und Mengenratgeber, Maschineneinstellungen und ein 10-seitiger Planer zum Ausdrucken. Gratis mit dem SewCraftly-Newsletter – dazu jedes neue kostenlose Schnittmuster direkt in dein Postfach.',
			'Tableau des tailles, retouches d’ajustement, guides des tissus et métrages, réglages de la machine et un planner de 10 pages à imprimer. Offert avec la newsletter SewCraftly, en plus de chaque nouveau patron gratuit dans votre boîte mail.',
		),
		'Get the free handbook'           => array( 'Gratis-Handbuch holen', 'Recevoir le guide offert' ),
		'20 pages · PDF'                  => array( '20 Seiten · PDF', '20 pages · PDF' ),
		'FREE 20-PAGE PRINTABLE'          => array( 'GRATIS · 20 SEITEN ZUM AUSDRUCKEN', 'OFFERT · 20 PAGES À IMPRIMER' ),
		'Size chart, fit fixes, fabric & yardage guides, machine settings, a sewing glossary and a 10-page planner, all ready to print. Tell us where to send it, and get every new free pattern too.' => array(
			'Größentabelle, Passform-Tipps, Stoff- und Mengenratgeber, Maschineneinstellungen, ein Näh-Glossar und ein 10-seitiger Planer – alles zum Ausdrucken. Sag uns, wohin wir es schicken sollen, und erhalte auch jedes neue kostenlose Schnittmuster.',
			'Tableau des tailles, retouches d’ajustement, guides des tissus et métrages, réglages de la machine, un glossaire de couture et un planner de 10 pages, prêts à imprimer. Dites-nous où l’envoyer et recevez aussi chaque nouveau patron gratuit.',
		),
		'Free 20-page Sewist’s Handbook'  => array( 'Gratis: 20-seitiges Nähhandbuch', 'Offert : guide de couture de 20 pages' ),
		'Size chart, fit fixes & sewing planner' => array( 'Größentabelle, Passform-Tipps & Nähplaner', 'Tailles, ajustements & planner couture' ),
		'Get it'                          => array( 'Holen', 'Je le veux' ),
		// "Send the pattern to your email" box under the download buttons
		'Send the pattern to your email'  => array( 'Schnittmuster per E-Mail schicken', 'Recevoir le patron par e-mail' ),
		'Get the A4 + US Letter links in your inbox and open them later on your computer to print.' => array( 'Erhalte die Links für A4 und US Letter per E-Mail und öffne sie später am Computer zum Ausdrucken.', 'Recevez les liens A4 et US Letter par e-mail et ouvrez-les plus tard sur votre ordinateur pour imprimer.' ),
		'Email me the pattern'            => array( 'Schnittmuster zuschicken', 'M’envoyer le patron' ),
		'Bonus: confirm your email to also get our free 20-page Sewist’s Handbook. No spam, unsubscribe anytime.' => array( 'Bonus: Bestätige deine E-Mail-Adresse und erhalte zusätzlich unser kostenloses 20-seitiges Nähhandbuch. Kein Spam, jederzeit abbestellbar.', 'Bonus : confirmez votre e-mail pour recevoir aussi notre guide de couture gratuit de 20 pages. Pas de spam, désinscription à tout moment.' ),
		'Privacy'                         => array( 'Datenschutz', 'Confidentialité' ),
		// Pattern posts: related cards, browse block, unit toggle, jump chips, Pinterest box
		'You might also like'             => array( 'Das könnte dir auch gefallen', 'Vous aimerez aussi' ),
		'Browse more free patterns'       => array( 'Weitere kostenlose Schnittmuster', 'Plus de patrons gratuits' ),
		'Measurement units'               => array( 'Maßeinheiten', 'Unités de mesure' ),
		'Jump to'                         => array( 'Springe zu', 'Aller à' ),
		'Free PDF pattern'                => array( 'Kostenloses PDF-Schnittmuster', 'Patron PDF gratuit' ),
		'Don’t lose this pattern!'        => array( 'Verlier dieses Schnittmuster nicht!', 'Ne perdez pas ce patron !' ),
		'Save it for your next make ♡'    => array( 'Merk es dir für dein nächstes Projekt ♡', 'Gardez-le pour votre prochain projet ♡' ),
		'Save it on Pinterest'            => array( 'Auf Pinterest merken', 'Enregistrer sur Pinterest' ),
	);
}

/* Exact source snippets inside scripts (strings, regexes, URLs), replaced as they are. */
function sc_i18n_raw( $l ) {
	$de = 'de' === $l;
	return array(
		"'Please enter a valid email address.'" => $de ? "'Bitte gib eine gültige E-Mail-Adresse ein.'" : "'Veuillez saisir une adresse e-mail valide.'",
		"'Sending...'"                          => $de ? "'Wird gesendet…'" : "'Envoi…'",
		"'Sending…'"                            => $de ? "'Wird gesendet…'" : "'Envoi…'",
		"'Almost there! Check your inbox to confirm.'" => $de ? "'Fast geschafft! Bitte bestätige die E-Mail in deinem Postfach.'" : "'Presque fini ! Confirmez votre inscription dans votre boîte mail.'",
		"'Something went wrong, please try again.'" => $de ? "'Da ist etwas schiefgelaufen, bitte versuch es noch einmal.'" : "'Une erreur est survenue, veuillez réessayer.'",
		"'Network error, please try again.'"    => $de ? "'Netzwerkfehler, bitte versuch es noch einmal.'" : "'Erreur réseau, veuillez réessayer.'",
		"'Send me my free handbook'"            => $de ? "'Schick mir mein Handbuch'" : "'Envoyez-moi mon guide'",
		"'Enter your best email'"               => $de ? "'Deine E-Mail-Adresse'" : "'Votre adresse e-mail'",
		'On your phone? Send the pattern to your email' => $de ? 'Am Handy? Schick dir das Schnittmuster per E-Mail' : 'Sur mobile ? Recevez le patron par e-mail',
		'↓ Free PDF pattern · A4 & US Letter'   => $de ? '↓ Kostenloses PDF-Schnittmuster · A4 & US Letter' : '↓ Patron PDF gratuit · A4 & US Letter',
		'/download/i.test(a.textContent)'       => '/download|herunterladen|télécharger/i.test(a.textContent)',
		'/get the pattern/i'                    => '/get the pattern|herunterladen|télécharger/i',
		'body:JSON.stringify({email:email,website:' => "body:JSON.stringify({lang:'" . $l . "',email:email,website:",
		'body:JSON.stringify({email:email,post:PID' => "body:JSON.stringify({lang:'" . $l . "',email:email,post:PID",
		// Jump-to chips and step accordions (post layout snippet)
		"['Download',dl],['Size chart',h2(/sizing guide/i)],['Materials',h2(/^\\s*materials/i)],['Sewing steps',h2(/sewing steps/i)],['FAQ',h2(/^\\s*(questions|faq)/i)]" => $de
			? "['Download',dl],['Größentabelle',h2(/größentabelle|sizing guide/i)],['Material',h2(/^\\s*material/i)],['Nähanleitung',h2(/nähanleitung|sewing steps/i)],['FAQ',h2(/^\\s*(häufige fragen|questions|faq)/i)]"
			: "['Télécharger',dl],['Tailles',h2(/guide des tailles|sizing guide/i)],['Fournitures',h2(/^\\s*fournitures/i)],['Étapes',h2(/étapes de couture|sewing steps/i)],['FAQ',h2(/^\\s*(questions|faq)/i)]",
		"'Jump to:'"                            => $de ? "'Springe zu:'" : "'Aller à :'",
		"'Jump to'"                             => $de ? "'Springe zu'" : "'Aller à'",
		"'Step '+(i+1)"                         => $de ? "'Schritt '+(i+1)" : "'Étape '+(i+1)",
		"indexOf('Expand')===0"                 => $de ? "indexOf('Alle Schritte auf')===0" : "indexOf('Tout dé')===0",
		"'Expand all steps'"                    => $de ? "'Alle Schritte aufklappen'" : "'Tout déplier'",
		"'Collapse all steps'"                  => $de ? "'Alle Schritte zuklappen'" : "'Tout replier'",
		"'Slide '+(k+1)"                        => $de ? "'Folie '+(k+1)" : "'Diapositive '+(k+1)",
		// cm / inches toggle
		'>inches</button>'                      => $de ? '>Zoll</button>' : '>pouces</button>',
		'/fabric|lining/i'                      => '/fabric|lining|stoff|futter|tissu|doublure/i',
		// Mobile menu: home link and search forms stay in the language
		"var home='/';"                         => "var home='/" . $l . "/';",
		'action="/"'                            => 'action="/' . $l . '/"',
		'View all &rarr;'                       => $de ? 'Alle ansehen &rarr;' : 'Tout voir &rarr;',
	);
}

/* Internal link => same page in the current language (categories, patterns, home). */
function sc_i18n_url( $url, $l ) {
	static $cache = array();
	$key = $l . '|' . $url;
	if ( isset( $cache[ $key ] ) ) {
		return $cache[ $key ];
	}
	$out  = $url;
	$p    = wp_parse_url( html_entity_decode( $url, ENT_QUOTES, 'UTF-8' ) );
	$host = isset( $p['host'] ) ? $p['host'] : '';
	$path = isset( $p['path'] ) ? $p['path'] : '';
	$frag = isset( $p['fragment'] ) ? '#' . $p['fragment'] : '';
	if ( ( '' === $host || 'sewcraftlypatterns.com' === $host ) && '' !== $path && '/' === $path[0]
		&& empty( $p['query'] ) && ! preg_match( '#^/(de|fr)(/|$)|^/(wp-|cdn-cgi|feed|tag/|author/)|\.\w{2,4}$#', $path ) ) {
		if ( '/' === $path ) {
			$out = pll_home_url( $l ) . $frag;
		} elseif ( preg_match( '#^/category/(?:.+/)?([^/]+)/?$#', $path, $m ) ) {
			$terms = get_terms( array( 'taxonomy' => 'category', 'slug' => $m[1], 'hide_empty' => false, 'lang' => '' ) );
			if ( $terms && ! is_wp_error( $terms ) ) {
				$tid = pll_get_term( $terms[0]->term_id, $l );
				if ( $tid ) {
					$link = get_term_link( (int) $tid, 'category' );
					if ( ! is_wp_error( $link ) ) {
						$out = $link . $frag;
					}
				}
			}
		} else {
			$pid = url_to_postid( home_url( $path ) );
			if ( $pid ) {
				$tid = pll_get_post( $pid, $l );
				if ( $tid && (int) $tid !== (int) $pid ) {
					$out = get_permalink( $tid ) . $frag;
				}
			}
		}
	}
	$cache[ $key ] = $out;
	return $out;
}

function sc_i18n_ob( $html ) {
	$l = sc_i18n_lang();
	if ( ! $l || strlen( $html ) < 500 || false === stripos( $html, '<html' ) ) {
		return $html;
	}
	$i   = 'de' === $l ? 0 : 1;
	$all = sc_i18n_texts();
	$T   = array();
	foreach ( $all as $en => $tr ) {
		$T[ $en ] = $tr[ $i ];
	}
	$raw = sc_i18n_raw( $l );
	if ( is_front_page() || is_home() ) {
		$t_en = 'SewCraftly - Free Sewing Patterns PDF & Step-by-Step Sewing Guides';
		$d_en = 'Free PDF sewing patterns for women: dresses, tops, pants, skirts and jackets in sizes XXS–4XL, A4 and US Letter, with step-by-step sewing instructions.';
		$t_tr = 'de' === $l ? 'SewCraftly – Kostenlose Schnittmuster als PDF & Nähanleitungen' : 'SewCraftly – Patrons de couture gratuits en PDF & tutoriels';
		$d_tr = 'de' === $l
			? 'Kostenlose Schnittmuster für Damen als PDF: Kleider, Oberteile, Hosen, Röcke und Jacken in Gr. 34–54, A4 und US Letter, mit Schritt-für-Schritt-Nähanleitung.'
			: 'Patrons de couture gratuits pour femme en PDF : robes, hauts, pantalons, jupes et vestes du 36 au 56, en A4 et US Letter, avec explications pas à pas.';
		foreach ( array( $t_en => $t_tr, $d_en => $d_tr ) as $en => $tr ) {
			$raw[ $en ] = $tr;
			$raw[ str_replace( '&', '&amp;', $en ) ] = str_replace( '&', '&amp;', $tr );
			$raw[ str_replace( '–', '&#8211;', $en ) ] = $tr;
		}
	}
	$html = strtr( $html, $raw );

	// placeholder / aria-label / title / alt
	$r = preg_replace_callback( '/\b(placeholder|aria-label|title|alt)="([^"<>]*)"/u', function ( $m ) use ( $T ) {
		$k = trim( html_entity_decode( $m[2], ENT_QUOTES | ENT_HTML5, 'UTF-8' ) );
		return isset( $T[ $k ] ) ? $m[1] . '="' . esc_attr( $T[ $k ] ) . '"' : $m[0];
	}, $html );
	if ( null !== $r ) {
		$html = $r;
	}

	// Text between tags (exact match, a leading emoji or symbol is kept)
	$r = preg_replace_callback( '/>([^<>]*[A-Za-z][^<>]*)</u', function ( $m ) use ( $T ) {
		$raw = $m[1];
		if ( strlen( $raw ) > 600 ) {
			return $m[0];
		}
		$txt = trim( preg_replace( '/\s+/u', ' ', html_entity_decode( $raw, ENT_QUOTES | ENT_HTML5, 'UTF-8' ) ) );
		$pre = '';
		$suf = '';
		if ( ! isset( $T[ $txt ] ) ) {
			// keep a leading symbol (arrow, emoji) and a trailing emoji around the known text
			if ( preg_match( '/^([^\p{L}\p{N}]*)(.+?)([\s\p{So}\p{Sk}\p{Cs}\x{FE0F}\x{200D}]*)$/u', $txt, $x ) && isset( $T[ $x[2] ] ) ) {
				$pre = $x[1];
				$txt = $x[2];
				$suf = $x[3];
			} else {
				return $m[0];
			}
		}
		preg_match( '/^\s*/u', $raw, $a );
		preg_match( '/\s*$/u', $raw, $b );
		return '>' . $a[0] . esc_html( $pre . $T[ $txt ] . $suf ) . $b[0] . '<';
	}, $html );
	if ( null !== $r ) {
		$html = $r;
	}

	// Links (the language switcher and hreflang links are left alone)
	$r = preg_replace_callback( '/<a\b[^>]*>/i', function ( $m ) use ( $l ) {
		$tag = $m[0];
		if ( false !== stripos( $tag, 'hreflang' ) ) {
			return $tag;
		}
		$n = preg_replace_callback( '/\bhref=(["\'])([^"\']+)\1/i', function ( $h ) use ( $l ) {
			$u = sc_i18n_url( $h[2], $l );
			return $u === $h[2] ? $h[0] : 'href=' . $h[1] . esc_url( $u ) . $h[1];
		}, $tag );
		return null === $n ? $tag : $n;
	}, $html );
	if ( null !== $r ) {
		$html = $r;
	}
	return $html;
}

/* Dates in the local format (28. Oktober 2026 / 28 octobre 2026) */
add_filter( 'option_date_format', function ( $f ) {
	if ( is_admin() ) {
		return $f;
	}
	$l = sc_i18n_lang();
	return 'de' === $l ? 'j. F Y' : ( 'fr' === $l ? 'j F Y' : $f );
} );

add_action( 'template_redirect', function () {
	if ( is_admin() || wp_doing_ajax() || is_feed() || is_robots() || is_embed() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return;
	}
	$uri = isset( $_SERVER['REQUEST_URI'] ) ? (string) $_SERVER['REQUEST_URI'] : '';
	if ( preg_match( '#sitemap|\.xml|\.txt#i', $uri ) || ! sc_i18n_lang() ) {
		return;
	}
	ob_start( 'sc_i18n_ob' );
}, 1 );

/* ---------- Form answers (REST) and emails in the visitor's language ---------- */
function sc_i18n_msgs() {
	return array(
		'Sent! Check your inbox (and the spam folder) for the A4 and US Letter links.' => array( 'Gesendet! Schau in dein Postfach (und in den Spam-Ordner): Dort findest du die Links für A4 und US Letter.', 'Envoyé ! Consultez votre boîte mail (et le dossier spam) pour trouver les liens A4 et US Letter.' ),
		'Please enter a valid email address.' => array( 'Bitte gib eine gültige E-Mail-Adresse ein.', 'Veuillez saisir une adresse e-mail valide.' ),
		'This pattern has no files to send.' => array( 'Für dieses Schnittmuster gibt es keine Dateien zum Versenden.', 'Ce patron n’a aucun fichier à envoyer.' ),
		'Too many requests, please try again later.' => array( 'Zu viele Anfragen, bitte versuch es später noch einmal.', 'Trop de demandes, veuillez réessayer plus tard.' ),
		'Too many attempts, please try again later.' => array( 'Zu viele Versuche, bitte versuch es später noch einmal.', 'Trop de tentatives, veuillez réessayer plus tard.' ),
		'We could not send the email right now. Please try again in a few minutes.' => array( 'Die E-Mail konnte gerade nicht gesendet werden. Bitte versuch es in ein paar Minuten noch einmal.', 'Impossible d’envoyer l’e-mail pour le moment. Veuillez réessayer dans quelques minutes.' ),
		'Almost there! Click the confirmation link we just emailed you (peek in your spam folder too) and your free 20-page Sewist\'s Handbook + Sewing Planner will land in your inbox a few minutes later.' => array(
			'Fast geschafft! Klick auf den Bestätigungslink, den wir dir gerade geschickt haben (schau auch im Spam-Ordner nach). Wenige Minuten später kommt dein kostenloses 20-seitiges Nähhandbuch + Nähplaner in deinem Postfach an.',
			'Presque fini ! Cliquez sur le lien de confirmation que nous venons de vous envoyer (regardez aussi dans les spams). Quelques minutes plus tard, vous recevrez notre guide de couture gratuit de 20 pages + planner.',
		),
		'Subscription is temporarily unavailable.' => array( 'Die Anmeldung ist vorübergehend nicht verfügbar.', 'L’inscription est momentanément indisponible.' ),
		'We could not send the confirmation email. Please try again later.' => array( 'Die Bestätigungs-E-Mail konnte nicht gesendet werden. Bitte versuch es später noch einmal.', 'Impossible d’envoyer l’e-mail de confirmation. Veuillez réessayer plus tard.' ),
	);
}

add_filter( 'rest_pre_dispatch', function ( $res, $server, $req ) {
	if ( 0 === strpos( $req->get_route(), '/sewcraftly/v1/' ) ) {
		$l = (string) $req->get_param( 'lang' );
		if ( 'de' === $l || 'fr' === $l ) {
			$GLOBALS['sc_i18n_req_lang'] = $l;
		}
	}
	return $res;
}, 10, 3 );

add_filter( 'rest_post_dispatch', function ( $resp, $server, $req ) {
	$l = isset( $GLOBALS['sc_i18n_req_lang'] ) ? $GLOBALS['sc_i18n_req_lang'] : '';
	if ( ! $l || ! ( $resp instanceof WP_REST_Response ) || 0 !== strpos( $req->get_route(), '/sewcraftly/v1/' ) ) {
		return $resp;
	}
	$d = $resp->get_data();
	if ( is_array( $d ) && isset( $d['message'] ) ) {
		$M = sc_i18n_msgs();
		if ( isset( $M[ $d['message'] ] ) ) {
			$d['message'] = $M[ $d['message'] ][ 'de' === $l ? 0 : 1 ];
			$resp->set_data( $d );
		}
	}
	// Remember the language of this address, so the handbook email is sent in it later.
	if ( $resp->get_status() < 300 ) {
		$e = strtolower( sanitize_email( (string) $req->get_param( 'email' ) ) );
		if ( $e ) {
			$map = get_option( 'sc_i18n_sub_lang', array() );
			if ( ! is_array( $map ) ) {
				$map = array();
			}
			$map[ md5( $e ) ] = $l;
			if ( count( $map ) > 5000 ) {
				$map = array_slice( $map, -5000, null, true );
			}
			update_option( 'sc_i18n_sub_lang', $map, false );
		}
	}
	return $resp;
}, 10, 3 );

add_filter( 'wp_mail', function ( $a ) {
	if ( ! empty( $GLOBALS['sc_i18n_skip_mail_filter'] ) || empty( $a['message'] ) || false === strpos( (string) $a['message'], 'SewCraftly' ) ) {
		return $a;
	}
	$l = isset( $GLOBALS['sc_i18n_req_lang'] ) ? $GLOBALS['sc_i18n_req_lang'] : '';
	if ( ! $l ) {
		$to  = is_array( $a['to'] ) ? reset( $a['to'] ) : $a['to'];
		$map = get_option( 'sc_i18n_sub_lang', array() );
		$k   = md5( strtolower( trim( (string) $to ) ) );
		$l   = ( is_array( $map ) && isset( $map[ $k ] ) ) ? $map[ $k ] : '';
	}
	if ( 'de' !== $l && 'fr' !== $l ) {
		return $a;
	}
	$de  = 'de' === $l;
	$msg = (string) $a['message'];
	$sub = (string) $a['subject'];
	$msg = preg_replace( '#>Your free (.+?) pattern</h1>#u', $de ? '>Dein kostenloses Schnittmuster: $1</h1>' : '>Votre patron gratuit : $1</h1>', $msg );
	$sub = preg_replace( '#^Your free (.+) sewing pattern \(A4 \+ US Letter\)$#u', $de ? 'Dein kostenloses Schnittmuster: $1 (A4 + US Letter)' : 'Votre patron de couture gratuit : $1 (A4 + US Letter)', $sub );
	$pairs = $de ? array(
		'Want every step illustrated? ' => 'Du möchtest jeden Schritt illustriert sehen? ',
		'>Get the printable step-by-step tutorial</a>' => '>Hol dir die Nähanleitung zum Ausdrucken</a>',
		'Here are your download links. Each ZIP holds one PDF per size. Open them on a computer, print page 1 at 100% (no scaling) and check the test square before printing the rest.' => 'Hier sind deine Download-Links. Jede ZIP-Datei enthält ein PDF pro Größe. Öffne sie am Computer, drucke Seite 1 in 100 % (ohne Skalierung) und prüfe das Testquadrat, bevor du den Rest druckst.',
		'>Open the pattern page</a> for the size chart, materials and sewing steps.' => '>Zur Schnittmuster-Seite</a> mit Größentabelle, Material und Nähanleitung.',
		'You asked for this pattern on sewcraftlypatterns.com. Happy sewing! The SewCraftly Team' => 'Du hast dieses Schnittmuster auf sewcraftlypatterns.com angefordert. Viel Spaß beim Nähen! Dein SewCraftly-Team',
		'>Your free gift</p>' => '>Dein Gratis-Geschenk</p>',
		'>Welcome to SewCraftly!</h1>' => '>Willkommen bei SewCraftly!</h1>',
		'Thank you for joining us. Here is your free <strong>Sewist&rsquo;s Handbook + Sewing Planner</strong>: 20 printable pages with our size chart, fit fixes, fabric and yardage guides, machine settings, a sewing glossary and a complete sewing planner.' => 'Danke für deine Anmeldung! Hier ist dein kostenloses <strong>Nähhandbuch + Nähplaner</strong>: 20 Seiten zum Ausdrucken mit Größentabelle, Passform-Tipps, Stoff- und Mengenratgeber, Maschineneinstellungen, Näh-Glossar und einem kompletten Nähplaner.',
		'>Download my handbook (PDF)</a>' => '>Handbuch herunterladen (PDF)</a>',
		'Tip: print it in A4 or US Letter and keep the planner pages in a binder next to your sewing machine.' => 'Tipp: Druck es in A4 aus und heb die Planer-Seiten in einem Ordner neben deiner Nähmaschine auf.',
		'>Ready for your next make?</p>' => '>Bereit für dein nächstes Nähprojekt?</p>',
		'Browse all our free sewing patterns &rarr;' => 'Alle kostenlosen Schnittmuster ansehen &rarr;',
		'You are receiving this email because you subscribed on sewcraftlypatterns.com. You can unsubscribe anytime with the link in our newsletters.' => 'Du erhältst diese E-Mail, weil du dich auf sewcraftlypatterns.com angemeldet hast. Über den Link in unseren Newslettern kannst du dich jederzeit abmelden.',
	) : array(
		'Want every step illustrated? ' => 'Vous voulez chaque étape illustrée ? ',
		'>Get the printable step-by-step tutorial</a>' => '>Obtenez le tutoriel pas à pas à imprimer</a>',
		'Here are your download links. Each ZIP holds one PDF per size. Open them on a computer, print page 1 at 100% (no scaling) and check the test square before printing the rest.' => 'Voici vos liens de téléchargement. Chaque fichier ZIP contient un PDF par taille. Ouvrez-les sur un ordinateur, imprimez la page 1 à 100 % (sans mise à l’échelle) et vérifiez le carré test avant d’imprimer le reste.',
		'>Open the pattern page</a> for the size chart, materials and sewing steps.' => '>Ouvrez la page du patron</a> pour le tableau des tailles, les fournitures et les étapes de couture.',
		'You asked for this pattern on sewcraftlypatterns.com. Happy sewing! The SewCraftly Team' => 'Vous avez demandé ce patron sur sewcraftlypatterns.com. Bonne couture ! L’équipe SewCraftly',
		'>Your free gift</p>' => '>Votre cadeau</p>',
		'>Welcome to SewCraftly!</h1>' => '>Bienvenue chez SewCraftly !</h1>',
		'Thank you for joining us. Here is your free <strong>Sewist&rsquo;s Handbook + Sewing Planner</strong>: 20 printable pages with our size chart, fit fixes, fabric and yardage guides, machine settings, a sewing glossary and a complete sewing planner.' => 'Merci pour votre inscription ! Voici votre <strong>guide de couture + planner</strong> offert : 20 pages à imprimer avec tableau des tailles, retouches d’ajustement, guides des tissus et métrages, réglages de la machine, glossaire de couture et un planner complet.',
		'>Download my handbook (PDF)</a>' => '>Télécharger le guide (PDF)</a>',
		'Tip: print it in A4 or US Letter and keep the planner pages in a binder next to your sewing machine.' => 'Astuce : imprimez-le en A4 et rangez les pages du planner dans un classeur près de votre machine à coudre.',
		'>Ready for your next make?</p>' => '>Prête pour votre prochain projet ?</p>',
		'Browse all our free sewing patterns &rarr;' => 'Voir tous nos patrons de couture gratuits &rarr;',
		'You are receiving this email because you subscribed on sewcraftlypatterns.com. You can unsubscribe anytime with the link in our newsletters.' => 'Vous recevez cet e-mail car vous vous êtes inscrite sur sewcraftlypatterns.com. Vous pouvez vous désinscrire à tout moment via le lien de nos newsletters.',
	);
	if ( function_exists( 'pll_home_url' ) ) {
		$pairs['href="' . home_url( '/' ) . '"'] = 'href="' . pll_home_url( $l ) . '"';
	}
	// Handbook PDF in the subscriber's language
	$pairs['https://files.sewcraftlypatterns.com/2026/10/sewcraftly-sewists-handbook.pdf'] = sc_i18n_handbook_url( $l );
	$a['message'] = strtr( $msg, $pairs );
	$a['subject'] = ( "Your free Sewist's Handbook + Sewing Planner" === $sub )
		? ( $de ? 'Dein kostenloses Nähhandbuch + Nähplaner (Sewist’s Handbook)' : 'Votre guide de couture offert (Sewist’s Handbook)' )
		: $sub;
	return $a;
} );

/* ---------- Handbook and newsletter confirmation in German / French ---------- */
function sc_i18n_handbook_url( $l ) {
	return 'de' === $l ? 'https://files.sewcraftlypatterns.com/2026/10/sewcraftly-naehhandbuch.pdf'
		: ( 'fr' === $l ? 'https://files.sewcraftlypatterns.com/2026/10/sewcraftly-guide-couture.pdf'
		: 'https://files.sewcraftlypatterns.com/2026/10/sewcraftly-sewists-handbook.pdf' );
}

/* Language of a subscribe request: its "lang" field, or the request that called it (send-pattern form). */
function sc_i18n_conf_lang( $req = null ) {
	$l = $req ? (string) $req->get_param( 'lang' ) : '';
	if ( 'de' !== $l && 'fr' !== $l ) {
		$l = isset( $GLOBALS['sc_i18n_req_lang'] ) ? $GLOBALS['sc_i18n_req_lang'] : '';
	}
	return ( 'de' === $l || 'fr' === $l ) ? $l : '';
}

/* Sends MailPoet's real confirmation link in a German or French email. Returns false if it could not. */
function sc_i18n_send_confirmation( $email, $l ) {
	try {
		$repo = \MailPoet\DI\ContainerWrapper::getInstance()->get( \MailPoet\Subscribers\SubscribersRepository::class );
		$sub  = $repo->findOneBy( array( 'email' => $email ) );
		if ( ! $sub ) {
			return false;
		}
		if ( 'subscribed' === $sub->getStatus() ) {
			return true; // already confirmed, nothing to send
		}
		$mp_url = \MailPoet\Subscription\SubscriptionUrlFactory::getInstance()->getConfirmationUrl( $sub );
	} catch ( \Throwable $e ) {
		error_log( 'SewCraftly i18n confirmation: ' . $e->getMessage() );
		return false;
	}
	if ( ! $mp_url ) {
		return false;
	}
	$url = add_query_arg( array( 'l' => $l, 'u' => rawurlencode( $mp_url ) ), rest_url( 'sewcraftly/v1/go' ) );
	$de  = 'de' === $l;
	$t   = $de ? array(
		'sub'   => 'Bitte bestätige deine Anmeldung bei SewCraftly',
		'eye'   => 'Nur noch ein Klick',
		'h'     => 'Fast geschafft!',
		'p'     => 'Bitte bestätige deine E-Mail-Adresse. Danach schicken wir dir dein kostenloses 20-seitiges Nähhandbuch + Nähplaner und jedes neue kostenlose Schnittmuster.',
		'btn'   => 'Anmeldung bestätigen',
		'small' => 'Du hast dich nicht angemeldet? Dann ignoriere diese E-Mail einfach – ohne Bestätigung bekommst du nichts von uns.',
	) : array(
		'sub'   => 'Confirmez votre inscription à SewCraftly',
		'eye'   => 'Plus qu’un clic',
		'h'     => 'Presque fini !',
		'p'     => 'Merci de confirmer votre adresse e-mail. Nous vous enverrons ensuite votre guide de couture + planner offert de 20 pages, et chaque nouveau patron gratuit.',
		'btn'   => 'Confirmer mon inscription',
		'small' => 'Vous ne vous êtes pas inscrite ? Ignorez simplement cet e-mail : sans confirmation, vous ne recevrez rien de notre part.',
	);
	$body = '<div style="background:#f7f0ea;padding:24px 12px;font-family:Arial,Helvetica,sans-serif">'
		. '<div style="max-width:520px;margin:0 auto;background:#fff;border-radius:16px;padding:32px 28px;text-align:center;color:#1f1f1f">'
		. '<p style="margin:0 0 6px;font-size:12px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#AE5340">' . esc_html( $t['eye'] ) . '</p>'
		. '<h1 style="font-size:24px;line-height:1.25;margin:0 0 12px">' . esc_html( $t['h'] ) . '</h1>'
		. '<p style="font-size:16px;line-height:1.55;margin:0 0 22px">' . esc_html( $t['p'] ) . '</p>'
		. '<p style="margin:0 0 22px"><a href="' . esc_url( $url ) . '" style="display:inline-block;background:#AE5340;color:#ffffff;text-decoration:none;font-weight:700;font-size:16px;padding:14px 28px;border-radius:999px">' . esc_html( $t['btn'] ) . '</a></p>'
		. '<p style="font-size:12px;line-height:1.5;margin:0;color:#8a807a">' . esc_html( $t['small'] ) . '</p>'
		. '</div><p style="max-width:520px;margin:16px auto 0;text-align:center;font-size:12px;color:#8a807a">SewCraftly · sewcraftlypatterns.com</p></div>';
	$GLOBALS['sc_i18n_skip_mail_filter'] = true;
	$ok = wp_mail( $email, $t['sub'], $body, array( 'Content-Type: text/html; charset=UTF-8', 'From: SewCraftly <' . get_option( 'admin_email' ) . '>' ) );
	unset( $GLOBALS['sc_i18n_skip_mail_filter'] );
	return (bool) $ok;
}

/* /wp-json/sewcraftly/v1/go : remembers the language, then opens MailPoet's confirmation link. */
add_action( 'rest_api_init', function () {
	register_rest_route( 'sewcraftly/v1', '/go', array(
		'methods'             => 'GET',
		'permission_callback' => '__return_true',
		'callback'            => function ( WP_REST_Request $req ) {
			$l = (string) $req->get_param( 'l' );
			$u = (string) $req->get_param( 'u' );
			if ( 0 !== strpos( $u, home_url( '/' ) ) ) {
				$u = home_url( '/' );
			}
			if ( 'de' === $l || 'fr' === $l ) {
				setcookie( 'sc_wl', $l, time() + 1800, '/', '', is_ssl(), true );
			}
			wp_redirect( $u, 302 );
			exit;
		},
	) );
} );

/* After confirming, MailPoet opens the English welcome page: send German / French visitors to theirs. */
add_action( 'template_redirect', function () {
	if ( ! is_page( 701 ) ) {
		return;
	}
	do_action( 'litespeed_control_set_nocache', 'welcome page language redirect' );
	$l = isset( $_COOKIE['sc_wl'] ) ? (string) $_COOKIE['sc_wl'] : '';
	if ( ( 'de' === $l || 'fr' === $l ) && function_exists( 'pll_get_post' ) ) {
		$tid = pll_get_post( 701, $l );
		if ( $tid ) {
			setcookie( 'sc_wl', '', time() - 3600, '/', '', is_ssl(), true );
			$to = get_permalink( $tid );
			if ( isset( $_GET['mailpoet_router'] ) ) {
				// Let MailPoet finish the confirmation on this request, then move on in the browser.
				add_action( 'wp_footer', function () use ( $to ) {
					echo '<script>location.replace(' . wp_json_encode( $to ) . ');</script>';
				}, 999 );
				return;
			}
			wp_redirect( $to, 302 );
			exit;
		}
	}
}, 0 );

/* Newsletter list for a language: German and French subscribers get their own list, so each one only receives the new-pattern email in their language. */
function sc_i18n_list_id( $l, $default ) {
	$map = array( 'de' => 4, 'fr' => 5 );
	return isset( $map[ $l ] ) ? $map[ $l ] : $default;
}

/* One time: switch on the German (52) and French (53) new-pattern emails. MailPoet's screen refuses while their lists are still empty. */
add_action( 'admin_init', function () {
	if ( get_option( 'sc_i18n_nl_active' ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	global $wpdb;
	$t = $wpdb->prefix . 'mailpoet_newsletters';
	foreach ( array( 52, 53 ) as $id ) {
		$wpdb->update( $t, array( 'status' => 'active' ), array( 'id' => $id, 'type' => 'notification' ) );
	}
	update_option( 'sc_i18n_nl_active', 1, false );
} );
}
