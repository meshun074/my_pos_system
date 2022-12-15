<script type="text/javascript">
    function printSection(el) {
        var getFullContent = document.body.innerHTML;
        var printScreen = document.getElementById(el).innerHTML;
        document.body.innerHTML = printScreen;
        window.print();
        document.body.innerHTML = getFullContent;
    }
</script>
