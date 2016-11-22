<script type="text/javascript" src="js/jquery-1.12.1.min.js"></script>
<!--
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-i18n.js"></script>
!-->
<script type="text/javascript">
    function cancelaOperacao(){
    var resp = confirm("Deseja realmente cancelar?");
    if(resp == true){
        window.location.href = "index.php";
    }
}
</script>