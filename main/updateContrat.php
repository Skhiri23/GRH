<?php

require_once ('connect.php');

	$id = $_GET['id'];
	$selSql = "SELECT * FROM `employe` WHERE id=$id";
	$res = mysqli_query($con, $selSql);
	$r = mysqli_fetch_assoc($res);

	if (isset($_POST) && !empty($_POST)) {
    $departement = $_POST['departement'];
    $poste = $_POST['poste'];
    $type_contrat = $_POST['type_contrat'];
    $salaire = $_POST['salaire'];
    $dateDebut = $_POST['dateDebut'];
    $dateFin = $_POST['dateFin'];
    $typeContrat = $_POST['typeContrat'];
    $horaire = $_POST['horaire'];
    $numcarte = $_POST['numcarte'];
    $UpdateSql = "UPDATE `employe` SET  departement='$departement', poste='$poste', type_contrat='$type_contrat', salaire='$salaire', dateDebut='$dateDebut', numcarte='$numcarte', dateFin='$dateFin', typeContrat='$typeContrat', horaire='$horaire', numcarte='$numcarte' WHERE id=$id";	
		$res = mysqli_query($con, $UpdateSql);
		if ($res) {
			header("location: viewcontrat.php");
		}else{
			$erreur = "la mise à jour a échoué.";
		}
	}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Aziz GRH</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
	<?php
		include 'navbar.php';
	 ?>

	<div class="container">
		<div class="row pt-4">
				<?php if (isset($erreur)) { ?>
				<div class="alert alert-danger" role="alert">
					<?php echo $erreur; ?>
				</div> <?php } ?>

			<form action="" method="POST" class="form-horizontal col-md-6 pt-4">
				<h2>Crud App by sen dev tech</h2>

            <legend>Contract Details</legend>
            <div class="form-group">
    <label for="inputDepartement" class="col-sm-2 control-label">Département</label>
    <div class="col-sm-10">
        <select class="form-control" id="inputDepartement" name="departement">
            <option value="developpement" <?php if($r['departement'] == 'developpement') echo 'selected'; ?>>Développement logiciel</option>
            <option value="gestion_projet" <?php if($r['departement'] == 'gestion_projet') echo 'selected'; ?>>Gestion de projet</option>
            <option value="qualite" <?php if($r['departement'] == 'qualite') echo 'selected'; ?>>Qualité logicielle</option>
            <option value="infra_reseaux" <?php if($r['departement'] == 'infra_reseaux') echo 'selected'; ?>>Infrastructure et Réseaux</option>
            <option value="conception_ux_ui" <?php if($r['departement'] == 'conception_ux_ui') echo 'selected'; ?>>Conception UX/UI</option>
            <option value="support_technique" <?php if($r['departement'] == 'support_technique') echo 'selected'; ?>>Support Technique</option>
            <option value="recherche_developpement" <?php if($r['departement'] == 'recherche_developpement') echo 'selected'; ?>>Recherche et Développement</option>
            <option value="Ressource_Humaine" <?php if($r['departement'] == 'Ressource_Humaine') echo 'selected'; ?>>Ressource Humaine</option>

        </select>
    </div>
</div>


<div class="form-group" id="postesContainer">
    <label for="inputPoste" class="col-sm-2 control-label">Poste</label>
    <div class="col-sm-10">
        <select class="form-control" id="inputPoste" name="poste">
            <?php
             foreach ($posteValues as $posteValue) {
                 echo '<option value="' . $posteValue . '"';
                 if ($defaultPoste == $posteValue) {
                    echo ' selected';  
                }
                echo '>' . $posteValue . '</option>';
            }
            ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="type_contrat" class="col-sm-2 control-label">Type de contrat</label>
    <div class="col-sm-10">
        <select name="type_contrat" id="type_contrat" class="form-control">
            <option value="CDI" <?php if($r['type_contrat'] == 'CDI') echo 'selected'; ?>>CDI (Contrat à Durée Indéterminée)</option>
            <option value="CDD" <?php if($r['type_contrat'] == 'CDD') echo 'selected'; ?>>CDD (Contrat à Durée Déterminée)</option>
            <option value="Stage" <?php if($r['type_contrat'] == 'Stage') echo 'selected'; ?>>Stage</option>
            <option value="Apprentissage" <?php if($r['type_contrat'] == 'Apprentissage') echo 'selected'; ?>>Apprentissage</option>
            <option value="Freelance" <?php if($r['type_contrat'] == 'Freelance') echo 'selected'; ?>>Freelance</option>
            <option value="Auto-entrepreneur" <?php if($r['type_contrat'] == 'Auto-entrepreneur') echo 'selected'; ?>>Auto-entrepreneur</option>
            <option value="Consultant" <?php if($r['type_contrat'] == 'Consultant') echo 'selected'; ?>>Consultant</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label for="inputSalaire" class="col-sm-2 control-label">Salaire brut </label>
    <div class="col-sm-10">
        <input type="text" name="salaire" placeholder="Salaire brut " class="form-control" id="inputSalaire" value="<?php echo $r['salaire']; ?>">
    </div>
</div>
<div class="form-group">
    <label for="numcarte" class="col-sm-2 control-label">Numero carte</label>
    <div class="col-sm-10">
        <input type="text" name="numcarte" class="form-control" id="numcarte" value="<?php echo $r['numcarte']; ?>">
    </div>
</div>

<div class="form-group">
    <label for="dateDebut" class="col-sm-2 control-label">Date de début</label>
    <div class="col-sm-10">
        <input type="date" name="dateDebut" class="form-control" id="dateDebut" value="<?php echo $r['dateDebut']; ?>">
    </div>
</div>

<div class="form-group">
    <label for="dateFin" class="col-sm-2 control-label">Date de fin</label>
    <div class="col-sm-10">
        <input type="date" name="dateFin" class="form-control" id="dateFin" value="<?php echo $r['dateFin']; ?>">
    </div>
</div>


<div class="form-group">
    <label for="NBjour" class="col-sm-2 control-label">Jour/semaine</label>
    <div class="col-sm-10">
        <select name="typeContrat" id="typeContrat" class="form-control">
            <option value="5 jours par semaine" <?php if($r['typeContrat'] == '5 jours par semaine') echo 'selected'; ?>>5 jours par semaine</option>
            <option value="4 jours par semaine" <?php if($r['typeContrat'] == '4 jours par semaine') echo 'selected'; ?>>4 jours par semaine</option>
            <option value="3 jours par semain" <?php if($r['typeContrat'] == '3 jours par semain') echo 'selected'; ?>>3 jours par semaine</option>
            <option value="Télétravail" <?php if($r['typeContrat'] == 'Télétravail') echo 'selected'; ?>>Télétravail</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="horaire" class="col-sm-2 control-label">Horaire</label>
    <div class="col-sm-10">
        <select name="horaire" id="horaire" class="form-control">
            <option value="8h00 à 16h00" <?php if($r['horaire'] == '8h00 à 16h00') echo 'selected'; ?>>8h00 à 16h00</option>
            <option value="9h00 à 17h00" <?php if($r['horaire'] == '9h00 à 17h00') echo 'selected'; ?>>9h00 à 17h00</option>
            <option value="10h00 à 18h00" <?php if($r['horaire'] == '10h00 à 18h00') echo 'selected'; ?>>10h00 à 18h00</option>
        </select>
    </div>
</div>
			<input type="submit" value="Submit" class="btn btn-success">        
				</div>
			</form>
		</div>
	</div>


	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script type='text/javascript' id="soledad-pagespeed-header" data-cfasync="false">!function(n,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(n="undefined"!=typeof globalThis?globalThis:n||self).LazyLoad=t()}(this,(function(){"use strict";function n(){return n=Object.assign||function(n){for(var t=1;t<arguments.length;t++){var e=arguments[t];for(var i in e)Object.prototype.hasOwnProperty.call(e,i)&&(n[i]=e[i])}return n},n.apply(this,arguments)}var t="undefined"!=typeof window,e=t&&!("onscroll"in window)||"undefined"!=typeof navigator&&/(gle|ing|ro)bot|crawl|spider/i.test(navigator.userAgent),i=t&&"IntersectionObserver"in window,o=t&&"classList"in document.createElement("p"),a=t&&window.devicePixelRatio>1,r={elements_selector:".lazy",container:e||t?document:null,threshold:300,thresholds:null,data_src:"src",data_srcset:"srcset",data_sizes:"sizes",data_bg:"bg",data_bg_hidpi:"bg-hidpi",data_bg_multi:"bg-multi",data_bg_multi_hidpi:"bg-multi-hidpi",data_poster:"poster",class_applied:"applied",class_loading:"loading",class_loaded:"loaded",class_error:"error",class_entered:"entered",class_exited:"exited",unobserve_completed:!0,unobserve_entered:!1,cancel_on_exit:!0,callback_enter:null,callback_exit:null,callback_applied:null,callback_loading:null,callback_loaded:null,callback_error:null,callback_finish:null,callback_cancel:null,use_native:!1},c=function(t){return n({},r,t)},u=function(n,t){var e,i="LazyLoad::Initialized",o=new n(t);try{e=new CustomEvent(i,{detail:{instance:o}})}catch(n){(e=document.createEvent("CustomEvent")).initCustomEvent(i,!1,!1,{instance:o})}window.dispatchEvent(e)},l="src",s="srcset",f="sizes",d="poster",_="llOriginalAttrs",g="loading",v="loaded",b="applied",p="error",h="native",m="data-",E="ll-status",I=function(n,t){return n.getAttribute(m+t)},y=function(n){return I(n,E)},A=function(n,t){return function(n,t,e){var i="data-ll-status";null!==e?n.setAttribute(i,e):n.removeAttribute(i)}(n,0,t)},k=function(n){return A(n,null)},L=function(n){return null===y(n)},w=function(n){return y(n)===h},x=[g,v,b,p],O=function(n,t,e,i){n&&(void 0===i?void 0===e?n(t):n(t,e):n(t,e,i))},N=function(n,t){o?n.classList.add(t):n.className+=(n.className?" ":"")+t},C=function(n,t){o?n.classList.remove(t):n.className=n.className.replace(new RegExp("(^|\\s+)"+t+"(\\s+|$)")," ").replace(/^\s+/,"").replace(/\s+$/,"")},M=function(n){return n.llTempImage},z=function(n,t){if(t){var e=t._observer;e&&e.unobserve(n)}},R=function(n,t){n&&(n.loadingCount+=t)},T=function(n,t){n&&(n.toLoadCount=t)},G=function(n){for(var t,e=[],i=0;t=n.children[i];i+=1)"SOURCE"===t.tagName&&e.push(t);return e},D=function(n,t){var e=n.parentNode;e&&"PICTURE"===e.tagName&&G(e).forEach(t)},V=function(n,t){G(n).forEach(t)},F=[l],j=[l,d],P=[l,s,f],S=function(n){return!!n[_]},U=function(n){return n[_]},$=function(n){return delete n[_]},q=function(n,t){if(!S(n)){var e={};t.forEach((function(t){e[t]=n.getAttribute(t)})),n[_]=e}},H=function(n,t){if(S(n)){var e=U(n);t.forEach((function(t){!function(n,t,e){e?n.setAttribute(t,e):n.removeAttribute(t)}(n,t,e[t])}))}},B=function(n,t,e){N(n,t.class_loading),A(n,g),e&&(R(e,1),O(t.callback_loading,n,e))},J=function(n,t,e){e&&n.setAttribute(t,e)},K=function(n,t){J(n,f,I(n,t.data_sizes)),J(n,s,I(n,t.data_srcset)),J(n,l,I(n,t.data_src))},Q={IMG:function(n,t){D(n,(function(n){q(n,P),K(n,t)})),q(n,P),K(n,t)},IFRAME:function(n,t){q(n,F),J(n,l,I(n,t.data_src))},VIDEO:function(n,t){V(n,(function(n){q(n,F),J(n,l,I(n,t.data_src))})),q(n,j),J(n,d,I(n,t.data_poster)),J(n,l,I(n,t.data_src)),n.load()}},W=["IMG","IFRAME","VIDEO"],X=function(n,t){!t||function(n){return n.loadingCount>0}(t)||function(n){return n.toLoadCount>0}(t)||O(n.callback_finish,t)},Y=function(n,t,e){n.addEventListener(t,e),n.llEvLisnrs[t]=e},Z=function(n,t,e){n.removeEventListener(t,e)},nn=function(n){return!!n.llEvLisnrs},tn=function(n){if(nn(n)){var t=n.llEvLisnrs;for(var e in t){var i=t[e];Z(n,e,i)}delete n.llEvLisnrs}},en=function(n,t,e){!function(n){delete n.llTempImage}(n),R(e,-1),function(n){n&&(n.toLoadCount-=1)}(e),C(n,t.class_loading),t.unobserve_completed&&z(n,e)},on=function(n,t,e){var i=M(n)||n;nn(i)||function(n,t,e){nn(n)||(n.llEvLisnrs={});var i="VIDEO"===n.tagName?"loadeddata":"load";Y(n,i,t),Y(n,"error",e)}(i,(function(o){!function(n,t,e,i){var o=w(t);en(t,e,i),N(t,e.class_loaded),A(t,v),O(e.callback_loaded,t,i),o||X(e,i)}(0,n,t,e),tn(i)}),(function(o){!function(n,t,e,i){var o=w(t);en(t,e,i),N(t,e.class_error),A(t,p),O(e.callback_error,t,i),o||X(e,i)}(0,n,t,e),tn(i)}))},an=function(n,t,e){!function(n){n.llTempImage=document.createElement("IMG")}(n),on(n,t,e),function(n){S(n)||(n[_]={backgroundImage:n.style.backgroundImage})}(n),function(n,t,e){var i=I(n,t.data_bg),o=I(n,t.data_bg_hidpi),r=a&&o?o:i;r&&(n.style.backgroundImage='url("'.concat(r,'")'),M(n).setAttribute(l,r),B(n,t,e))}(n,t,e),function(n,t,e){var i=I(n,t.data_bg_multi),o=I(n,t.data_bg_multi_hidpi),r=a&&o?o:i;r&&(n.style.backgroundImage=r,function(n,t,e){N(n,t.class_applied),A(n,b),e&&(t.unobserve_completed&&z(n,t),O(t.callback_applied,n,e))}(n,t,e))}(n,t,e)},rn=function(n,t,e){!function(n){return W.indexOf(n.tagName)>-1}(n)?an(n,t,e):function(n,t,e){on(n,t,e),function(n,t,e){var i=Q[n.tagName];i&&(i(n,t),B(n,t,e))}(n,t,e)}(n,t,e)},cn=function(n){n.removeAttribute(l),n.removeAttribute(s),n.removeAttribute(f)},un=function(n){D(n,(function(n){H(n,P)})),H(n,P)},ln={IMG:un,IFRAME:function(n){H(n,F)},VIDEO:function(n){V(n,(function(n){H(n,F)})),H(n,j),n.load()}},sn=function(n,t){(function(n){var t=ln[n.tagName];t?t(n):function(n){if(S(n)){var t=U(n);n.style.backgroundImage=t.backgroundImage}}(n)})(n),function(n,t){L(n)||w(n)||(C(n,t.class_entered),C(n,t.class_exited),C(n,t.class_applied),C(n,t.class_loading),C(n,t.class_loaded),C(n,t.class_error))}(n,t),k(n),$(n)},fn=["IMG","IFRAME","VIDEO"],dn=function(n){return n.use_native&&"loading"in HTMLImageElement.prototype},_n=function(n,t,e){n.forEach((function(n){return function(n){return n.isIntersecting||n.intersectionRatio>0}(n)?function(n,t,e,i){var o=function(n){return x.indexOf(y(n))>=0}(n);A(n,"entered"),N(n,e.class_entered),C(n,e.class_exited),function(n,t,e){t.unobserve_entered&&z(n,e)}(n,e,i),O(e.callback_enter,n,t,i),o||rn(n,e,i)}(n.target,n,t,e):function(n,t,e,i){L(n)||(N(n,e.class_exited),function(n,t,e,i){e.cancel_on_exit&&function(n){return y(n)===g}(n)&&"IMG"===n.tagName&&(tn(n),function(n){D(n,(function(n){cn(n)})),cn(n)}(n),un(n),C(n,e.class_loading),R(i,-1),k(n),O(e.callback_cancel,n,t,i))}(n,t,e,i),O(e.callback_exit,n,t,i))}(n.target,n,t,e)}))},gn=function(n){return Array.prototype.slice.call(n)},vn=function(n){return n.container.querySelectorAll(n.elements_selector)},bn=function(n){return function(n){return y(n)===p}(n)},pn=function(n,t){return function(n){return gn(n).filter(L)}(n||vn(t))},hn=function(n,e){var o=c(n);this._settings=o,this.loadingCount=0,function(n,t){i&&!dn(n)&&(t._observer=new IntersectionObserver((function(e){_n(e,n,t)}),function(n){return{root:n.container===document?null:n.container,rootMargin:n.thresholds||n.threshold+"px"}}(n)))}(o,this),function(n,e){t&&window.addEventListener("online",(function(){!function(n,t){var e;(e=vn(n),gn(e).filter(bn)).forEach((function(t){C(t,n.class_error),k(t)})),t.update()}(n,e)}))}(o,this),this.update(e)};return hn.prototype={update:function(n){var t,o,a=this._settings,r=pn(n,a);T(this,r.length),!e&&i?dn(a)?function(n,t,e){n.forEach((function(n){-1!==fn.indexOf(n.tagName)&&function(n,t,e){n.setAttribute("loading","lazy"),on(n,t,e),function(n,t){var e=Q[n.tagName];e&&e(n,t)}(n,t),A(n,h)}(n,t,e)})),T(e,0)}(r,a,this):(o=r,function(n){n.disconnect()}(t=this._observer),function(n,t){t.forEach((function(t){n.observe(t)}))}(t,o)):this.loadAll(r)},destroy:function(){this._observer&&this._observer.disconnect(),vn(this._settings).forEach((function(n){$(n)})),delete this._observer,delete this._settings,delete this.loadingCount,delete this.toLoadCount},loadAll:function(n){var t=this,e=this._settings;pn(n,e).forEach((function(n){z(n,t),rn(n,e,t)}))},restoreAll:function(){var n=this._settings;vn(n).forEach((function(t){sn(t,n)}))}},hn.load=function(n,t){var e=c(t);rn(n,e)},hn.resetStatus=function(n){k(n)},t&&function(n,t){if(t)if(t.length)for(var e,i=0;e=t[i];i+=1)u(n,e);else u(n,t)}(hn,window.lazyLoadOptions),hn}));

(function () {

    var PenciLazy = new LazyLoad({
        elements_selector: '.penci-lazy',
        data_bg: 'bgset',
        class_loading: 'lazyloading',
        class_entered: 'lazyloaded',
        class_loaded: 'pcloaded',
        unobserve_entered: true
    });

    MutationObserver = window.MutationObserver || window.WebKitMutationObserver;

    var observer = new MutationObserver(function(mutations, observer) {
        PenciLazy.update();
    });

    observer.observe(document, {
        subtree: true,
        attributes: true
    });
})();
</script>

<script>
$(document).ready(function() {
     function populatePosteDropdown(selectedDepartment) {
        var postes = [];
         $('#inputPoste').empty();
         switch (selectedDepartment) {
            case 'developpement':
                postes = ['Développeur', 'Ingénieur QA', 'Architecte logiciel', 'Développeur front-end', 'Développeur back-end'];
                break;
            case 'gestion_projet':
                postes = ['Chef de projet', 'Assistant chef de projet', 'Analyste fonctionnel', 'Chef de projet technique', 'Scrum Master'];
                break;
                case 'qualite':
        postes = ['Analyste qualité', 'Testeur logiciel', 'Responsable qualité', 'Auditeur qualité', 'Analyste de sécurité informatique'];
        break;
    case 'infra_reseaux':
        postes = ['Administrateur système', 'Ingénieur réseau', 'Technicien support', 'Spécialiste en cybersécurité', 'Architecte infrastructure'];
        break;
    case 'conception_ux_ui':
        postes = ['Designer UX/UI', 'Concepteur graphique', 'Intégrateur web', 'UX Researcher', 'Spécialiste en accessibilité web'];
        break;
    case 'support_technique':
        postes = ['Technicien informatique', 'Hotliner', 'Spécialiste en maintenance', 'Technicien réseau', 'Technicien helpdesk'];
        break;
    case 'recherche_developpement':
        postes = ['Chercheur', 'Scientifique des données', 'Ingénieur R&D', 'Analyste en intelligence artificielle', 'Spécialiste en apprentissage automatique'];
        break;
        case 'Ressource_Humaine':
        postes = ['Agent RH'];
        break;
            default:
                break;
        }
         $.each(postes, function(index, value) {
            $('#inputPoste').append($('<option>').text(value).attr('value', value));
        });
         $('#postesContainer').show();
    }

     var defaultDepartment = $('#inputDepartement').val();
    populatePosteDropdown(defaultDepartment);

     $('#inputDepartement').change(function() {
        var selectedDepartment = $(this).val();
        populatePosteDropdown(selectedDepartment);
    });
});
</script>
</body>
</html>