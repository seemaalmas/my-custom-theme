function openWidget(url) {
    const widget = document.getElementById('fullPageWidget');
    const iframe = document.getElementById('widgetIframe');
    iframe.src = url;
    widget.style.display = 'block';
}

function closeWidget() {
    const widget = document.getElementById('fullPageWidget');
    const iframe = document.getElementById('widgetIframe');
    iframe.src = '';
    widget.style.display = 'none';
}
