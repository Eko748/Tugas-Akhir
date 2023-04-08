<script>
    const textToCrop = document.querySelector('.text-to-crop');
    let cropButton;

    function addCropButton() {
        const selectedText = window.getSelection().toString();
        if (selectedText.length > 0 && !cropButton) {
            cropButton = document.createElement('button');
            cropButton.textContent = 'Crop';

            textToCrop.appendChild(cropButton);

            const selectionRange = window.getSelection().getRangeAt(0);
            const selectionRect = selectionRange.getBoundingClientRect();

            const cropButtonLeft = selectionRect.left + (selectionRect.width / 2) - (cropButton.offsetWidth / 2);
            const cropButtonTop = selectionRect.top - cropButton.offsetHeight -
            10;

            cropButton.style.position = 'absolute';
            cropButton.style.left = cropButtonLeft + 'px';
            cropButton.style.top = cropButtonTop + 'px';

            cropButton.addEventListener('click', function() {
                window.location.href = 'halaman-tujuan.html';
            });
        }
    }

    function removeCropButton() {
        if (cropButton) {
            cropButton.remove();
            cropButton = null;
        }
    }

    textToCrop.addEventListener('mouseup', addCropButton);

    document.addEventListener('mouseup', function() {
        if (cropButton && window.getSelection().toString().length === 0) {
            removeCropButton();
        }
    });
</script>
