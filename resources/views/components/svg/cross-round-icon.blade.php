@props(['width' => 20, 'height' => 20, 'fill' => 'none', 'stroke' => '#636A80'])

<svg width="{{ $width }}" height="{{ $height }}" viewBox="0 0 20 20" fill="none"
    xmlns="http://www.w3.org/2000/svg">
    <path
        d="M10 20C15.5228 20 20 15.5228 20 10C20 4.47715 15.5228 0 10 0C4.47715 0 0 4.47715 0 10C0 15.5228 4.47715 20 10 20Z"
        fill="white" />
    <path d="M12.9995 7L6.99951 13" stroke="{{ $stroke }}" stroke-width="1.2" stroke-linecap="round"
        stroke-linejoin="round" />
    <path d="M6.99951 7L12.9995 13" stroke="{{ $stroke }}" stroke-width="1.2" stroke-linecap="round"
        stroke-linejoin="round" />
</svg>
