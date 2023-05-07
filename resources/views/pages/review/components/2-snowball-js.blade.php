<script type="text/javascript">
    $(document).ready(function() {
        const params = new URLSearchParams(window.location.search);
        let slr_code = null;
        if (params !== null) {
            slr_code = params.get('slr_code');
            console.log(slr_code);
            $('.slr-code').val(slr_code);
            const inputHidden = document.querySelector('.slr-code');
            if (inputHidden !== null) {
                inputHidden.style.display = 'block';
                inputHidden.value = slr_code;
                console.log('Oke');
            } else {
                console.log("It's Oke");
            }
        } else {
            const inputHidden = document.querySelector('.slr-code');
            if (inputHidden !== null) {
                inputHidden.style.display = 'none';
            }
        }
    });
</script>
