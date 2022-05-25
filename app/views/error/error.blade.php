<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $e->getMessage() }}</title>
    <style>*,:after,:before{box-sizing:border-box;border:0 solid #e5e7eb}:after,:before{--tw-content:""}html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;-o-tab-size:4;tab-size:4;font-family:ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:initial}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:initial;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:initial}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0}fieldset,legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}textarea{resize:vertical}input::-moz-placeholder,textarea::-moz-placeholder{opacity:1;color:#9ca3af}input:-ms-input-placeholder,textarea:-ms-input-placeholder{opacity:1;color:#9ca3af}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*,:after,:before{--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:#3b82f680;--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.absolute{position:absolute}.relative{position:relative}.inset-0{top:0;right:0;bottom:0;left:0}.top-1\/2{top:50%}.left-1\/2{left:50%}.-z-10{z-index:-10}.mx-auto{margin-left:auto;margin-right:auto}.ml-4{margin-left:1rem}.mb-5{margin-bottom:1.25rem}.flex{display:flex}.table{display:table}.hidden{display:none}.h-6{height:1.5rem}.h-0{height:0}.h-1{height:.25rem}.h-4{height:1rem}.h-5{height:1.25rem}.h-9{height:2.25rem}.h-10{height:2.5rem}.h-11{height:2.75rem}.h-12{height:3rem}.h-16{height:4rem}.h-24{height:6rem}.min-h-screen{min-height:100vh}.w-6{width:1.5rem}.w-0{width:0}.w-1{width:.25rem}.w-10{width:2.5rem}.w-11{width:2.75rem}.w-56{width:14rem}.w-60{width:15rem}.w-2{width:.5rem}.w-\[60rem\]{width:60rem}.w-\[100\%\]{width:100%}.max-w-none{max-width:none}.max-w-md{max-width:28rem}.flex-none{flex:none}.-translate-x-1\/2{--tw-translate-x:-50%}.-translate-x-1\/2,.-translate-y-1\/2{transform:translate(var(--tw-translate-x),var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.-translate-y-1\/2{--tw-translate-y:-50%}.flex-col{flex-direction:column}.items-center{align-items:center}.justify-center{justify-content:center}.justify-between{justify-content:space-between}.space-y-6>:not([hidden])~:not([hidden]){--tw-space-y-reverse:0;margin-top:calc(1.5rem*(1 - var(--tw-space-y-reverse)));margin-bottom:calc(1.5rem*var(--tw-space-y-reverse))}.space-y-4>:not([hidden])~:not([hidden]){--tw-space-y-reverse:0;margin-top:calc(1rem*(1 - var(--tw-space-y-reverse)));margin-bottom:calc(1rem*var(--tw-space-y-reverse))}.divide-y>:not([hidden])~:not([hidden]){--tw-divide-y-reverse:0;border-top-width:calc(1px*(1 - var(--tw-divide-y-reverse)));border-bottom-width:calc(1px*var(--tw-divide-y-reverse))}.divide-x-0>:not([hidden])~:not([hidden]){--tw-divide-x-reverse:0;border-right-width:calc(0px*var(--tw-divide-x-reverse));border-left-width:calc(0px*(1 - var(--tw-divide-x-reverse)))}.divide-gray-300\/50>:not([hidden])~:not([hidden]){border-color:#d1d5db80}.overflow-hidden{overflow:hidden}.text-ellipsis{text-overflow:ellipsis}.rounded-none{border-radius:0}.rounded-full{border-radius:9999px}.rounded{border-radius:.25rem}.border-4{border-width:4px}.border-2{border-width:2px}.border-b-2{border-bottom-width:2px}.border-zinc-200{--tw-border-opacity:1;border-color:rgb(228 228 231/var(--tw-border-opacity))}.border-slate-300{--tw-border-opacity:1;border-color:rgb(203 213 225/var(--tw-border-opacity))}.border-slate-400{--tw-border-opacity:1;border-color:rgb(148 163 184/var(--tw-border-opacity))}.bg-gray-50{--tw-bg-opacity:1;background-color:rgb(249 250 251/var(--tw-bg-opacity))}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255/var(--tw-bg-opacity))}.bg-slate-400{--tw-bg-opacity:1;background-color:rgb(148 163 184/var(--tw-bg-opacity))}.bg-slate-200{--tw-bg-opacity:1;background-color:rgb(226 232 240/var(--tw-bg-opacity))}.bg-\[url\(\/img\/grid\.svg\)\]{background-image:url(/img/grid.svg)}.bg-center{background-position:50%}.fill-sky-100{fill:#e0f2fe}.stroke-sky-500{stroke:#0ea5e9}.stroke-2{stroke-width:2}.p-12{padding:3rem}.p-6{padding:1.5rem}.p-2{padding:.5rem}.p-4{padding:1rem}.p-3{padding:.75rem}.py-6{padding-top:1.5rem;padding-bottom:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.py-8{padding-top:2rem;padding-bottom:2rem}.pt-10{padding-top:2.5rem}.pb-8{padding-bottom:2rem}.pt-8{padding-top:2rem}.text-center{text-align:center}.text-base{font-size:1rem;line-height:1.5rem}.text-sm{font-size:.875rem;line-height:1.25rem}.text-lg{font-size:1.125rem}.text-lg,.text-xl{line-height:1.75rem}.text-xl{font-size:1.25rem}.text-3xl{font-size:1.875rem;line-height:2.25rem}.text-2xl{font-size:1.5rem;line-height:2rem}.font-bold{font-weight:700}.font-semibold{font-weight:600}.leading-7{line-height:1.75rem}.text-gray-600{--tw-text-opacity:1;color:rgb(75 85 99/var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity:1;color:rgb(17 24 39/var(--tw-text-opacity))}.text-sky-500{--tw-text-opacity:1;color:rgb(14 165 233/var(--tw-text-opacity))}.text-gray-400{--tw-text-opacity:1;color:rgb(156 163 175/var(--tw-text-opacity))}.text-red-700{--tw-text-opacity:1;color:rgb(185 28 28/var(--tw-text-opacity))}.text-red-900{--tw-text-opacity:1;color:rgb(127 29 29/var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.shadow-xl{--tw-shadow:0 20px 25px -5px #0000001a,0 8px 10px -6px #0000001a;--tw-shadow-colored:0 20px 25px -5px var(--tw-shadow-color),0 8px 10px -6px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow,0 0 #0000),var(--tw-ring-shadow,0 0 #0000),var(--tw-shadow)}.ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow,0 0 #0000)}.ring-gray-900\/5{--tw-ring-color:#1118270d}.ring-slate-300{--tw-ring-opacity:1;--tw-ring-color:rgb(203 213 225/var(--tw-ring-opacity))}.\[mask-image\:linear-gradient\(180deg\2c white\2c rgba\(255\2c 255\2c 255\2c 0\)\)\]{-webkit-mask-image:linear-gradient(180deg,#fff,#fff0);mask-image:linear-gradient(180deg,#fff,#fff0)}.hover\:text-sky-600:hover{--tw-text-opacity:1;color:rgb(2 132 199/var(--tw-text-opacity))}@media (min-width:640px){.sm\:mx-auto{margin-left:auto;margin-right:auto}.sm\:max-w-5xl{max-width:64rem}.sm\:rounded-lg{border-radius:.5rem}.sm\:py-12{padding-top:3rem;padding-bottom:3rem}.sm\:px-10{padding-left:2.5rem;padding-right:2.5rem}}</style>
</head>

<body>
    <div class="absolute inset-0 bg-[url(/img/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))] -z-10"></div>
    <div class="flex flex-col p-12">
        <div class="border-4 bg-white shadow-xl ring-1 ring-gray-900/5 rounded p-6 mb-5">
            <div class="border-b-2 p-2 text-gray-400 border-zinc-200 flex justify-between">
                <span>
                    {{ $_SERVER['DOCUMENT_ROOT'] }}
                </span>
                <span>
                    {{ $_SERVER['SERVER_SOFTWARE'] }} | UnknownRori-PHP {{ env('APP_VERSION') }}
                </span>
            </div>
            <div class="p-4">
                <h4 class="text-gray-400">
                    {{ isset($e->getTrace()[0]['class']) ? $e->getTrace()[0]['class'] : $e->getTrace()[0]['function'] }}
                </h4>
                <h1 class=" text-3xl p-4 text-red-700">
                    {{ $e->getMessage() }}
                </h1>
            </div>
            <span class="text-gray-400 text-sm underline">
                <a href="">http:://{{ $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] }}</a>
            </span>
        </div>
        <div class="border-4 bg-white shadow-xl ring-1 ring-gray-900/5 rounded p-6 mb-5">
            <div>
                <h2 class="text-2xl text-red-900 p-3">
                    Stack Trace
                </h2>
            </div>
            <div>
                <table class="border-2 border-slate-300 w-[100%] shadow-xl ring-1 rounded">
                    <tr class="border-2 border-slate-300 bg-slate-400">
                        <td class="p-3 ring-1 ring-slate-300 text-center">Trace</td>
                        <td class="p-3 ring-1 ring-slate-300">File</td>
                        <td class="p-3 ring-1 ring-slate-300">Class / Function</td>
                        <td class="p-3 ring-1 ring-slate-300">Line</td>
                    </tr>
                    @foreach($e->getTrace() as $key=>$data)
                    <tr class="border-slate-400 bg-slate-200">
                        <td class="p-3 ring-slate-300 ring-1 text-center">{{ $key }}</td>
                        <td class="p-3 ring-slate-300 ring-1">{{ isset($data['file']) ? $data['file'] : $data['function'] }}</td>
                        <td class="p-3 ring-slate-300 ring-1">{{ isset($data['class']) ? $data['class'] . $data['type'] . $data['function'] : $data['function'] }}</td>
                        <td class="p-3 ring-slate-300 ring-1">{{ isset($data['line']) ? $data['line'] : '' }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</body>

</html>