<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>API PEMERIKSAAN</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "https://ti054a02.agussbn.my.id";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.2.1.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.2.1.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-eresep" class="tocify-header">
                <li class="tocify-item level-1" data-unique="eresep">
                    <a href="#eresep">EResep</a>
                </li>
                                    <ul id="tocify-subheader-eresep" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="eresep-GETapi-e-resep">
                                <a href="#eresep-GETapi-e-resep">Ambil semua data e-resep beserta detailnya.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="eresep-POSTapi-e-resep">
                                <a href="#eresep-POSTapi-e-resep">Tambah data e-resep baru.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="eresep-GETapi-e-resep--id-">
                                <a href="#eresep-GETapi-e-resep--id-">Tampilkan detail e-resep tertentu.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="eresep-PUTapi-e-resep--id-">
                                <a href="#eresep-PUTapi-e-resep--id-">Update data e-resep tertentu.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="eresep-DELETEapi-e-resep--id-">
                                <a href="#eresep-DELETEapi-e-resep--id-">Hapus data e-resep tertentu.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-eresep-detail" class="tocify-header">
                <li class="tocify-item level-1" data-unique="eresep-detail">
                    <a href="#eresep-detail">EResep Detail</a>
                </li>
                                    <ul id="tocify-subheader-eresep-detail" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="eresep-detail-GETapi-e-resepdetail">
                                <a href="#eresep-detail-GETapi-e-resepdetail">Tampilkan semua detail e-resep tertentu.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="eresep-detail-POSTapi-e-resepdetail">
                                <a href="#eresep-detail-POSTapi-e-resepdetail">Simpan detail resep baru untuk e-resep tertentu.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="eresep-detail-GETapi-e-resepdetail--id-">
                                <a href="#eresep-detail-GETapi-e-resepdetail--id-">Tampilkan detail resep tertentu.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="eresep-detail-PUTapi-e-resepdetail--id-">
                                <a href="#eresep-detail-PUTapi-e-resepdetail--id-">Perbarui detail resep.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="eresep-detail-DELETEapi-e-resepdetail--id-">
                                <a href="#eresep-detail-DELETEapi-e-resepdetail--id-">Hapus detail resep.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-jadwal" class="tocify-header">
                <li class="tocify-item level-1" data-unique="jadwal">
                    <a href="#jadwal">Jadwal</a>
                </li>
                                    <ul id="tocify-subheader-jadwal" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="jadwal-GETapi-jadwal-dokter">
                                <a href="#jadwal-GETapi-jadwal-dokter">Ambil daftar jadwal dokter beserta nama dokter.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="jadwal-GETapi-jadwal">
                                <a href="#jadwal-GETapi-jadwal">Ambil daftar jadwal beserta nama perawat.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-pemeriksaan" class="tocify-header">
                <li class="tocify-item level-1" data-unique="pemeriksaan">
                    <a href="#pemeriksaan">Pemeriksaan</a>
                </li>
                                    <ul id="tocify-subheader-pemeriksaan" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="pemeriksaan-GETapi-pemeriksaan">
                                <a href="#pemeriksaan-GETapi-pemeriksaan">Ambil daftar seluruh pemeriksaan beserta data pasien dari API eksternal.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="pemeriksaan-POSTapi-pemeriksaan">
                                <a href="#pemeriksaan-POSTapi-pemeriksaan">Simpan data pemeriksaan baru atau update jika sudah ada.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="pemeriksaan-GETapi-pemeriksaan--no_registrasi-">
                                <a href="#pemeriksaan-GETapi-pemeriksaan--no_registrasi-">Ambil detail pemeriksaan dan data pasien berdasarkan nomor registrasi.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="pemeriksaan-PUTapi-pemeriksaan--no_registrasi--diagnosa">
                                <a href="#pemeriksaan-PUTapi-pemeriksaan--no_registrasi--diagnosa">Update diagnosa dan tindakan oleh dokter.</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: June 30, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>https://ti054a02.agussbn.my.id</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="eresep">EResep</h1>

    

                                <h2 id="eresep-GETapi-e-resep">Ambil semua data e-resep beserta detailnya.</h2>

<p>
</p>



<span id="example-requests-GETapi-e-resep">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://ti054a02.agussbn.my.id/api/e-resep" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ti054a02.agussbn.my.id/api/e-resep"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-e-resep">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;no_registrasi&quot;: &quot;12345&quot;,
        &quot;details&quot;: [
            {
                &quot;id_obat&quot;: 1,
                &quot;jumlah&quot;: 2,
                &quot;aturan_pakai&quot;: &quot;3x sehari&quot;
            }
        ]
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-e-resep" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-e-resep"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-e-resep"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-e-resep" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-e-resep">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-e-resep" data-method="GET"
      data-path="api/e-resep"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-e-resep', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-e-resep"
                    onclick="tryItOut('GETapi-e-resep');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-e-resep"
                    onclick="cancelTryOut('GETapi-e-resep');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-e-resep"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/e-resep</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-e-resep"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-e-resep"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="eresep-POSTapi-e-resep">Tambah data e-resep baru.</h2>

<p>
</p>



<span id="example-requests-POSTapi-e-resep">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://ti054a02.agussbn.my.id/api/e-resep" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"no_registrasi\": \"12345\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ti054a02.agussbn.my.id/api/e-resep"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "no_registrasi": "12345"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-e-resep">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;no_registrasi&quot;: &quot;12345&quot;,
    &quot;details&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-e-resep" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-e-resep"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-e-resep"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-e-resep" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-e-resep">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-e-resep" data-method="POST"
      data-path="api/e-resep"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-e-resep', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-e-resep"
                    onclick="tryItOut('POSTapi-e-resep');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-e-resep"
                    onclick="cancelTryOut('POSTapi-e-resep');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-e-resep"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/e-resep</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-e-resep"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-e-resep"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>no_registrasi</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="no_registrasi"                data-endpoint="POSTapi-e-resep"
               value="12345"
               data-component="body">
    <br>
<p>Nomor registrasi pasien. Example: <code>12345</code></p>
        </div>
        </form>

                    <h2 id="eresep-GETapi-e-resep--id-">Tampilkan detail e-resep tertentu.</h2>

<p>
</p>



<span id="example-requests-GETapi-e-resep--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://ti054a02.agussbn.my.id/api/e-resep/2" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ti054a02.agussbn.my.id/api/e-resep/2"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-e-resep--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;no_registrasi&quot;: &quot;12345&quot;,
    &quot;details&quot;: [
        {
            &quot;id_obat&quot;: 1,
            &quot;jumlah&quot;: 2,
            &quot;aturan_pakai&quot;: &quot;3x sehari&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-e-resep--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-e-resep--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-e-resep--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-e-resep--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-e-resep--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-e-resep--id-" data-method="GET"
      data-path="api/e-resep/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-e-resep--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-e-resep--id-"
                    onclick="tryItOut('GETapi-e-resep--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-e-resep--id-"
                    onclick="cancelTryOut('GETapi-e-resep--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-e-resep--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/e-resep/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-e-resep--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-e-resep--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-e-resep--id-"
               value="2"
               data-component="url">
    <br>
<p>The ID of the e resep. Example: <code>2</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>e_resep</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="e_resep"                data-endpoint="GETapi-e-resep--id-"
               value="1"
               data-component="url">
    <br>
<p>ID resep yang ingin ditampilkan. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="eresep-PUTapi-e-resep--id-">Update data e-resep tertentu.</h2>

<p>
</p>



<span id="example-requests-PUTapi-e-resep--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://ti054a02.agussbn.my.id/api/e-resep/2" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"no_registrasi\": \"12345\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ti054a02.agussbn.my.id/api/e-resep/2"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "no_registrasi": "12345"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-e-resep--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;no_registrasi&quot;: &quot;12345&quot;,
    &quot;details&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-e-resep--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-e-resep--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-e-resep--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-e-resep--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-e-resep--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-e-resep--id-" data-method="PUT"
      data-path="api/e-resep/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-e-resep--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-e-resep--id-"
                    onclick="tryItOut('PUTapi-e-resep--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-e-resep--id-"
                    onclick="cancelTryOut('PUTapi-e-resep--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-e-resep--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/e-resep/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/e-resep/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-e-resep--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-e-resep--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-e-resep--id-"
               value="2"
               data-component="url">
    <br>
<p>The ID of the e resep. Example: <code>2</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>e_resep</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="e_resep"                data-endpoint="PUTapi-e-resep--id-"
               value="1"
               data-component="url">
    <br>
<p>ID resep yang akan diupdate. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>no_registrasi</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="no_registrasi"                data-endpoint="PUTapi-e-resep--id-"
               value="12345"
               data-component="body">
    <br>
<p>Nomor registrasi baru. Example: <code>12345</code></p>
        </div>
        </form>

                    <h2 id="eresep-DELETEapi-e-resep--id-">Hapus data e-resep tertentu.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-e-resep--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://ti054a02.agussbn.my.id/api/e-resep/2" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ti054a02.agussbn.my.id/api/e-resep/2"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-e-resep--id-">
            <blockquote>
            <p>Example response (204):</p>
        </blockquote>
                <pre>
<code>Empty response</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-e-resep--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-e-resep--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-e-resep--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-e-resep--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-e-resep--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-e-resep--id-" data-method="DELETE"
      data-path="api/e-resep/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-e-resep--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-e-resep--id-"
                    onclick="tryItOut('DELETEapi-e-resep--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-e-resep--id-"
                    onclick="cancelTryOut('DELETEapi-e-resep--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-e-resep--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/e-resep/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-e-resep--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-e-resep--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-e-resep--id-"
               value="2"
               data-component="url">
    <br>
<p>The ID of the e resep. Example: <code>2</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>e_resep</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="e_resep"                data-endpoint="DELETEapi-e-resep--id-"
               value="1"
               data-component="url">
    <br>
<p>ID resep yang ingin dihapus. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="eresep-detail">EResep Detail</h1>

    

                                <h2 id="eresep-detail-GETapi-e-resepdetail">Tampilkan semua detail e-resep tertentu.</h2>

<p>
</p>



<span id="example-requests-GETapi-e-resepdetail">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://ti054a02.agussbn.my.id/api/e-resepdetail" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ti054a02.agussbn.my.id/api/e-resepdetail"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-e-resepdetail">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id_resep&quot;: 1,
        &quot;id_obat&quot;: &quot;OBT001&quot;,
        &quot;jumlah&quot;: 2,
        &quot;aturan_pakai&quot;: &quot;3x1&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-e-resepdetail" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-e-resepdetail"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-e-resepdetail"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-e-resepdetail" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-e-resepdetail">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-e-resepdetail" data-method="GET"
      data-path="api/e-resepdetail"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-e-resepdetail', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-e-resepdetail"
                    onclick="tryItOut('GETapi-e-resepdetail');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-e-resepdetail"
                    onclick="cancelTryOut('GETapi-e-resepdetail');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-e-resepdetail"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/e-resepdetail</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-e-resepdetail"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-e-resepdetail"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>e_resep</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="e_resep"                data-endpoint="GETapi-e-resepdetail"
               value="1"
               data-component="url">
    <br>
<p>ID e-resep. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="eresep-detail-POSTapi-e-resepdetail">Simpan detail resep baru untuk e-resep tertentu.</h2>

<p>
</p>



<span id="example-requests-POSTapi-e-resepdetail">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://ti054a02.agussbn.my.id/api/e-resepdetail" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"id_obat\": \"OBT001\",
    \"jumlah\": 2,
    \"aturan_pakai\": \"3x1\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ti054a02.agussbn.my.id/api/e-resepdetail"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id_obat": "OBT001",
    "jumlah": 2,
    "aturan_pakai": "3x1"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-e-resepdetail">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id_resep&quot;: 1,
    &quot;id_obat&quot;: &quot;OBT001&quot;,
    &quot;jumlah&quot;: 2,
    &quot;aturan_pakai&quot;: &quot;3x1&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-e-resepdetail" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-e-resepdetail"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-e-resepdetail"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-e-resepdetail" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-e-resepdetail">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-e-resepdetail" data-method="POST"
      data-path="api/e-resepdetail"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-e-resepdetail', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-e-resepdetail"
                    onclick="tryItOut('POSTapi-e-resepdetail');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-e-resepdetail"
                    onclick="cancelTryOut('POSTapi-e-resepdetail');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-e-resepdetail"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/e-resepdetail</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-e-resepdetail"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-e-resepdetail"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>e_resep</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="e_resep"                data-endpoint="POSTapi-e-resepdetail"
               value="1"
               data-component="url">
    <br>
<p>ID e-resep. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>id_obat</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id_obat"                data-endpoint="POSTapi-e-resepdetail"
               value="OBT001"
               data-component="body">
    <br>
<p>ID obat. Example: <code>OBT001</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>jumlah</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="jumlah"                data-endpoint="POSTapi-e-resepdetail"
               value="2"
               data-component="body">
    <br>
<p>Jumlah obat. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>aturan_pakai</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="aturan_pakai"                data-endpoint="POSTapi-e-resepdetail"
               value="3x1"
               data-component="body">
    <br>
<p>Aturan pakai. Example: <code>3x1</code></p>
        </div>
        </form>

                    <h2 id="eresep-detail-GETapi-e-resepdetail--id-">Tampilkan detail resep tertentu.</h2>

<p>
</p>



<span id="example-requests-GETapi-e-resepdetail--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://ti054a02.agussbn.my.id/api/e-resepdetail/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ti054a02.agussbn.my.id/api/e-resepdetail/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-e-resepdetail--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id_resep&quot;: 1,
    &quot;id_obat&quot;: &quot;OBT001&quot;,
    &quot;jumlah&quot;: 2,
    &quot;aturan_pakai&quot;: &quot;3x1&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-e-resepdetail--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-e-resepdetail--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-e-resepdetail--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-e-resepdetail--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-e-resepdetail--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-e-resepdetail--id-" data-method="GET"
      data-path="api/e-resepdetail/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-e-resepdetail--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-e-resepdetail--id-"
                    onclick="tryItOut('GETapi-e-resepdetail--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-e-resepdetail--id-"
                    onclick="cancelTryOut('GETapi-e-resepdetail--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-e-resepdetail--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/e-resepdetail/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-e-resepdetail--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-e-resepdetail--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-e-resepdetail--id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the e resepdetail. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>e_resep</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="e_resep"                data-endpoint="GETapi-e-resepdetail--id-"
               value="1"
               data-component="url">
    <br>
<p>ID e-resep. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>detail_e_resep</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="detail_e_resep"                data-endpoint="GETapi-e-resepdetail--id-"
               value="1"
               data-component="url">
    <br>
<p>ID detail resep. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="eresep-detail-PUTapi-e-resepdetail--id-">Perbarui detail resep.</h2>

<p>
</p>



<span id="example-requests-PUTapi-e-resepdetail--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://ti054a02.agussbn.my.id/api/e-resepdetail/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"id_obat\": \"OBT001\",
    \"jumlah\": 2,
    \"aturan_pakai\": \"3x1\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ti054a02.agussbn.my.id/api/e-resepdetail/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id_obat": "OBT001",
    "jumlah": 2,
    "aturan_pakai": "3x1"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-e-resepdetail--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id_resep&quot;: 1,
    &quot;id_obat&quot;: &quot;OBT001&quot;,
    &quot;jumlah&quot;: 2,
    &quot;aturan_pakai&quot;: &quot;3x1&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-e-resepdetail--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-e-resepdetail--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-e-resepdetail--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-e-resepdetail--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-e-resepdetail--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-e-resepdetail--id-" data-method="PUT"
      data-path="api/e-resepdetail/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-e-resepdetail--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-e-resepdetail--id-"
                    onclick="tryItOut('PUTapi-e-resepdetail--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-e-resepdetail--id-"
                    onclick="cancelTryOut('PUTapi-e-resepdetail--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-e-resepdetail--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/e-resepdetail/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/e-resepdetail/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-e-resepdetail--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-e-resepdetail--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-e-resepdetail--id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the e resepdetail. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>e_resep</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="e_resep"                data-endpoint="PUTapi-e-resepdetail--id-"
               value="1"
               data-component="url">
    <br>
<p>ID e-resep. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>detail_e_resep</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="detail_e_resep"                data-endpoint="PUTapi-e-resepdetail--id-"
               value="1"
               data-component="url">
    <br>
<p>ID detail resep. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>id_obat</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="id_obat"                data-endpoint="PUTapi-e-resepdetail--id-"
               value="OBT001"
               data-component="body">
    <br>
<p>ID obat. Example: <code>OBT001</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>jumlah</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="jumlah"                data-endpoint="PUTapi-e-resepdetail--id-"
               value="2"
               data-component="body">
    <br>
<p>Jumlah obat. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>aturan_pakai</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="aturan_pakai"                data-endpoint="PUTapi-e-resepdetail--id-"
               value="3x1"
               data-component="body">
    <br>
<p>Aturan pakai. Example: <code>3x1</code></p>
        </div>
        </form>

                    <h2 id="eresep-detail-DELETEapi-e-resepdetail--id-">Hapus detail resep.</h2>

<p>
</p>



<span id="example-requests-DELETEapi-e-resepdetail--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://ti054a02.agussbn.my.id/api/e-resepdetail/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ti054a02.agussbn.my.id/api/e-resepdetail/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-e-resepdetail--id-">
            <blockquote>
            <p>Example response (204):</p>
        </blockquote>
                <pre>
<code>Empty response</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-e-resepdetail--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-e-resepdetail--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-e-resepdetail--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-e-resepdetail--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-e-resepdetail--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-e-resepdetail--id-" data-method="DELETE"
      data-path="api/e-resepdetail/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-e-resepdetail--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-e-resepdetail--id-"
                    onclick="tryItOut('DELETEapi-e-resepdetail--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-e-resepdetail--id-"
                    onclick="cancelTryOut('DELETEapi-e-resepdetail--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-e-resepdetail--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/e-resepdetail/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-e-resepdetail--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-e-resepdetail--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-e-resepdetail--id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the e resepdetail. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>e_resep</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="e_resep"                data-endpoint="DELETEapi-e-resepdetail--id-"
               value="1"
               data-component="url">
    <br>
<p>ID e-resep. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>detail_e_resep</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="detail_e_resep"                data-endpoint="DELETEapi-e-resepdetail--id-"
               value="1"
               data-component="url">
    <br>
<p>ID detail resep. Example: <code>1</code></p>
            </div>
                    </form>


                <h1 id="jadwal">Jadwal</h1>

    

                                <h2 id="jadwal-GETapi-jadwal-dokter">Ambil daftar jadwal dokter beserta nama dokter.</h2>

<p>
</p>



<span id="example-requests-GETapi-jadwal-dokter">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://ti054a02.agussbn.my.id/api/jadwal-dokter" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ti054a02.agussbn.my.id/api/jadwal-dokter"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-jadwal-dokter">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id_jadwal&quot;: 1,
        &quot;nama_dokter&quot;: &quot;Dr. Smith&quot;,
        &quot;hari&quot;: &quot;Senin&quot;,
        &quot;jam_mulai&quot;: &quot;08:00&quot;,
        &quot;jam_akhir&quot;: &quot;16:00&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-jadwal-dokter" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-jadwal-dokter"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-jadwal-dokter"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-jadwal-dokter" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-jadwal-dokter">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-jadwal-dokter" data-method="GET"
      data-path="api/jadwal-dokter"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-jadwal-dokter', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-jadwal-dokter"
                    onclick="tryItOut('GETapi-jadwal-dokter');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-jadwal-dokter"
                    onclick="cancelTryOut('GETapi-jadwal-dokter');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-jadwal-dokter"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/jadwal-dokter</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-jadwal-dokter"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-jadwal-dokter"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="jadwal-GETapi-jadwal">Ambil daftar jadwal beserta nama perawat.</h2>

<p>
</p>



<span id="example-requests-GETapi-jadwal">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://ti054a02.agussbn.my.id/api/jadwal" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ti054a02.agussbn.my.id/api/jadwal"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-jadwal">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;nama_perawat&quot;: &quot;John Doe&quot;,
        &quot;hari&quot;: &quot;Senin&quot;,
        &quot;jam&quot;: &quot;08:00 - 16:00&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-jadwal" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-jadwal"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-jadwal"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-jadwal" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-jadwal">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-jadwal" data-method="GET"
      data-path="api/jadwal"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-jadwal', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-jadwal"
                    onclick="tryItOut('GETapi-jadwal');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-jadwal"
                    onclick="cancelTryOut('GETapi-jadwal');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-jadwal"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/jadwal</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-jadwal"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-jadwal"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="pemeriksaan">Pemeriksaan</h1>

    

                                <h2 id="pemeriksaan-GETapi-pemeriksaan">Ambil daftar seluruh pemeriksaan beserta data pasien dari API eksternal.</h2>

<p>
</p>



<span id="example-requests-GETapi-pemeriksaan">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://ti054a02.agussbn.my.id/api/pemeriksaan" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ti054a02.agussbn.my.id/api/pemeriksaan"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-pemeriksaan">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;status&quot;: &quot;success&quot;,
  &quot;data&quot;: [
    {
      &quot;pasien&quot;: {
        &quot;no_registrasi&quot;: 1,
        &quot;rm&quot;: 12345,
        // ...data pasien lain...
      },
      &quot;pemeriksaan&quot;: {
        &quot;no_registrasi&quot;: 1,
        &quot;rm&quot;: 12345,
        &quot;suhu&quot;: 370,
        &quot;tensi&quot;: &quot;120/80&quot;,
        &quot;tinggi_badan&quot;: 170,
        &quot;berat_badan&quot;: 65,
        &quot;keluhan&quot;: &quot;Pusing&quot;,
        &quot;diagnosa&quot;: &quot;Flu&quot;,
        &quot;tindakan&quot;: &quot;Obat&quot;,
        &quot;id_perawat&quot;: 1,
        &quot;id_dokter&quot;: 2
      }
    }
  ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-pemeriksaan" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-pemeriksaan"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-pemeriksaan"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-pemeriksaan" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-pemeriksaan">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-pemeriksaan" data-method="GET"
      data-path="api/pemeriksaan"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-pemeriksaan', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-pemeriksaan"
                    onclick="tryItOut('GETapi-pemeriksaan');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-pemeriksaan"
                    onclick="cancelTryOut('GETapi-pemeriksaan');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-pemeriksaan"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/pemeriksaan</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-pemeriksaan"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-pemeriksaan"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="pemeriksaan-POSTapi-pemeriksaan">Simpan data pemeriksaan baru atau update jika sudah ada.</h2>

<p>
</p>



<span id="example-requests-POSTapi-pemeriksaan">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://ti054a02.agussbn.my.id/api/pemeriksaan" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"no_registrasi\": 1,
    \"rm\": 12345,
    \"suhu\": 370,
    \"tensi\": \"120\\/80\",
    \"tinggi_badan\": 170,
    \"berat_badan\": 65,
    \"keluhan\": \"Pusing\",
    \"diagnosa\": \"Flu\",
    \"tindakan\": \"Obat\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ti054a02.agussbn.my.id/api/pemeriksaan"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "no_registrasi": 1,
    "rm": 12345,
    "suhu": 370,
    "tensi": "120\/80",
    "tinggi_badan": 170,
    "berat_badan": 65,
    "keluhan": "Pusing",
    "diagnosa": "Flu",
    "tindakan": "Obat"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-pemeriksaan">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Data berhasil disimpan&quot;,
    &quot;data&quot;: {
        &quot;no_registrasi&quot;: 1,
        &quot;rm&quot;: 12345,
        &quot;suhu&quot;: 370,
        &quot;tensi&quot;: &quot;120/80&quot;,
        &quot;tinggi_badan&quot;: 170,
        &quot;berat_badan&quot;: 65,
        &quot;keluhan&quot;: &quot;Pusing&quot;,
        &quot;diagnosa&quot;: &quot;Flu&quot;,
        &quot;tindakan&quot;: &quot;Obat&quot;,
        &quot;id_perawat&quot;: 1,
        &quot;id_dokter&quot;: null
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Validasi gagal&quot;,
    &quot;errors&quot;: {
        &quot;suhu&quot;: [
            &quot;The suhu must be between 350 and 450.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-pemeriksaan" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-pemeriksaan"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-pemeriksaan"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-pemeriksaan" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-pemeriksaan">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-pemeriksaan" data-method="POST"
      data-path="api/pemeriksaan"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-pemeriksaan', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-pemeriksaan"
                    onclick="tryItOut('POSTapi-pemeriksaan');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-pemeriksaan"
                    onclick="cancelTryOut('POSTapi-pemeriksaan');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-pemeriksaan"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/pemeriksaan</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-pemeriksaan"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-pemeriksaan"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>no_registrasi</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="no_registrasi"                data-endpoint="POSTapi-pemeriksaan"
               value="1"
               data-component="body">
    <br>
<p>Nomor registrasi pasien. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rm</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rm"                data-endpoint="POSTapi-pemeriksaan"
               value="12345"
               data-component="body">
    <br>
<p>Nomor rekam medis. Example: <code>12345</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>suhu</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="suhu"                data-endpoint="POSTapi-pemeriksaan"
               value="370"
               data-component="body">
    <br>
<p>Suhu tubuh (350-450). Example: <code>370</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tensi</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tensi"                data-endpoint="POSTapi-pemeriksaan"
               value="120/80"
               data-component="body">
    <br>
<p>Tekanan darah (format: 120/80). Example: <code>120/80</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tinggi_badan</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tinggi_badan"                data-endpoint="POSTapi-pemeriksaan"
               value="170"
               data-component="body">
    <br>
<p>Tinggi badan (30-300 cm). Example: <code>170</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>berat_badan</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="berat_badan"                data-endpoint="POSTapi-pemeriksaan"
               value="65"
               data-component="body">
    <br>
<p>Berat badan (1-500 kg). Example: <code>65</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>keluhan</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="keluhan"                data-endpoint="POSTapi-pemeriksaan"
               value="Pusing"
               data-component="body">
    <br>
<p>Keluhan pasien. Example: <code>Pusing</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>diagnosa</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="diagnosa"                data-endpoint="POSTapi-pemeriksaan"
               value="Flu"
               data-component="body">
    <br>
<p>Diagnosa. Example: <code>Flu</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tindakan</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="tindakan"                data-endpoint="POSTapi-pemeriksaan"
               value="Obat"
               data-component="body">
    <br>
<p>Tindakan. Example: <code>Obat</code></p>
        </div>
        </form>

                    <h2 id="pemeriksaan-GETapi-pemeriksaan--no_registrasi-">Ambil detail pemeriksaan dan data pasien berdasarkan nomor registrasi.</h2>

<p>
</p>



<span id="example-requests-GETapi-pemeriksaan--no_registrasi-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://ti054a02.agussbn.my.id/api/pemeriksaan/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ti054a02.agussbn.my.id/api/pemeriksaan/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-pemeriksaan--no_registrasi-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;status&quot;: &quot;success&quot;,
  &quot;data&quot;: {
    &quot;pasien&quot;: {
      &quot;no_registrasi&quot;: 1,
      &quot;rm&quot;: 12345,
      &quot;jenis_kelamin&quot;: &quot;L&quot;,
      // ...data pasien lain...
    },
    &quot;pemeriksaan&quot;: {
      &quot;no_registrasi&quot;: 1,
      &quot;rm&quot;: 12345,
      &quot;suhu&quot;: 370,
      &quot;tensi&quot;: &quot;120/80&quot;,
      &quot;tinggi_badan&quot;: 170,
      &quot;berat_badan&quot;: 65,
      &quot;keluhan&quot;: &quot;Pusing&quot;,
      &quot;diagnosa&quot;: &quot;Flu&quot;,
      &quot;tindakan&quot;: &quot;Obat&quot;,
      &quot;id_perawat&quot;: 1,
      &quot;id_dokter&quot;: 2
    }
  }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Data pasien tidak ditemukan di API&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-pemeriksaan--no_registrasi-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-pemeriksaan--no_registrasi-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-pemeriksaan--no_registrasi-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-pemeriksaan--no_registrasi-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-pemeriksaan--no_registrasi-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-pemeriksaan--no_registrasi-" data-method="GET"
      data-path="api/pemeriksaan/{no_registrasi}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-pemeriksaan--no_registrasi-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-pemeriksaan--no_registrasi-"
                    onclick="tryItOut('GETapi-pemeriksaan--no_registrasi-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-pemeriksaan--no_registrasi-"
                    onclick="cancelTryOut('GETapi-pemeriksaan--no_registrasi-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-pemeriksaan--no_registrasi-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/pemeriksaan/{no_registrasi}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-pemeriksaan--no_registrasi-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-pemeriksaan--no_registrasi-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>no_registrasi</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="no_registrasi"                data-endpoint="GETapi-pemeriksaan--no_registrasi-"
               value="1"
               data-component="url">
    <br>
<p>Nomor registrasi pasien. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="pemeriksaan-PUTapi-pemeriksaan--no_registrasi--diagnosa">Update diagnosa dan tindakan oleh dokter.</h2>

<p>
</p>



<span id="example-requests-PUTapi-pemeriksaan--no_registrasi--diagnosa">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://ti054a02.agussbn.my.id/api/pemeriksaan/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"diagnosa\": \"Flu\",
    \"tindakan\": \"Obat\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ti054a02.agussbn.my.id/api/pemeriksaan/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "diagnosa": "Flu",
    "tindakan": "Obat"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-pemeriksaan--no_registrasi--diagnosa">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;success&quot;,
    &quot;message&quot;: &quot;Diagnosa berhasil disimpan&quot;,
    &quot;data&quot;: {
        &quot;no_registrasi&quot;: 1,
        &quot;diagnosa&quot;: &quot;Flu&quot;,
        &quot;tindakan&quot;: &quot;Obat&quot;,
        &quot;id_dokter&quot;: 2
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Data pemeriksaan tidak ditemukan&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Validasi gagal&quot;,
    &quot;errors&quot;: {
        &quot;diagnosa&quot;: [
            &quot;The diagnosa field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-pemeriksaan--no_registrasi--diagnosa" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-pemeriksaan--no_registrasi--diagnosa"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-pemeriksaan--no_registrasi--diagnosa"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-pemeriksaan--no_registrasi--diagnosa" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-pemeriksaan--no_registrasi--diagnosa">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-pemeriksaan--no_registrasi--diagnosa" data-method="PUT"
      data-path="api/pemeriksaan/{no_registrasi}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-pemeriksaan--no_registrasi--diagnosa', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-pemeriksaan--no_registrasi--diagnosa"
                    onclick="tryItOut('PUTapi-pemeriksaan--no_registrasi--diagnosa');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-pemeriksaan--no_registrasi--diagnosa"
                    onclick="cancelTryOut('PUTapi-pemeriksaan--no_registrasi--diagnosa');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-pemeriksaan--no_registrasi--diagnosa"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/pemeriksaan/{no_registrasi}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-pemeriksaan--no_registrasi--diagnosa"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-pemeriksaan--no_registrasi--diagnosa"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>no_registrasi</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="no_registrasi"                data-endpoint="PUTapi-pemeriksaan--no_registrasi--diagnosa"
               value="1"
               data-component="url">
    <br>
<p>Nomor registrasi pasien. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>diagnosa</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="diagnosa"                data-endpoint="PUTapi-pemeriksaan--no_registrasi--diagnosa"
               value="Flu"
               data-component="body">
    <br>
<p>Diagnosa. Example: <code>Flu</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tindakan</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tindakan"                data-endpoint="PUTapi-pemeriksaan--no_registrasi--diagnosa"
               value="Obat"
               data-component="body">
    <br>
<p>Tindakan. Example: <code>Obat</code></p>
        </div>
        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
