<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Undangan Pernikahan')</title>
        
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Pinyon+Script&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap" rel="stylesheet">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#3A141A] antialiased" x-data="{ loaded: false }" x-init="document.readyState === 'complete' ? loaded = true : window.addEventListener('load', () => setTimeout(() => loaded = true, 500))">
        {{-- Preloader --}}
        <div 
            x-show="!loaded"
            x-transition:leave="transition ease-in-out duration-700"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[100] mx-auto flex max-w-md flex-col items-center justify-center bg-[#5B0017]"
        >
            <div class="relative flex items-center justify-center">
                <div class="absolute h-20 w-20 animate-[spin_3s_linear_infinite] rounded-full border-t-2 border-b-2 border-[#D4AF37]/60"></div>
                <div class="absolute h-14 w-14 animate-[spin_2s_linear_infinite_reverse] rounded-full border-r-2 border-l-2 border-[#D4AF37]/40"></div>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D4AF37" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="animate-pulse">
                    <path d="M20.8 4.6a5.5 5.5 0 00-7.7 0l-1.1 1-1.1-1a5.5 5.5 0 00-7.8 7.8l1 1 7.9 7.9 7.9-7.9 1-1a5.5 5.5 0 000-7.8z"/>
                </svg>
            </div>
            <p class="mt-6 text-[9px] font-semibold uppercase tracking-[0.4em] text-[#D4AF37]/60 animate-pulse">Memuat Undangan</p>
        </div>

        <main class="mx-auto flex min-h-dvh w-full max-w-md flex-col bg-transparent shadow-2xl relative">
            {{-- Background Animation Layer (WebGL Shader) --}}
            <div class="fixed inset-0 z-0 mx-auto max-w-md overflow-hidden pointer-events-none">
                <canvas id="shader-canvas-batik" style="display:block;width:100%;height:100%"></canvas>
                <script>
                (function() {
                  const canvas = document.getElementById('shader-canvas-batik');

                  function syncSize() {
                    const w = canvas.clientWidth  || 480; // max-w-md usually ~448px
                    const h = canvas.clientHeight || 800;
                    if (canvas.width !== w || canvas.height !== h) {
                      canvas.width  = w;
                      canvas.height = h;
                    }
                  }
                  if (typeof ResizeObserver !== 'undefined') {
                    new ResizeObserver(syncSize).observe(canvas);
                  }
                  syncSize();

                  const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
                  if (!gl) return;
                  const vs = `attribute vec2 a_position;
                varying vec2 v_texCoord;
                void main() {
                  v_texCoord = a_position * 0.5 + 0.5;
                  gl_Position = vec4(a_position, 0.0, 1.0);
                }`;
                  const fs = `precision highp float;

                uniform float u_time;
                uniform vec2 u_resolution;
                uniform vec2 u_mouse;

                varying vec2 v_texCoord;

                float hash(vec2 p) {
                    p = fract(p * vec2(123.34, 456.21));
                    p += dot(p, p + 45.32);
                    return fract(p.x * p.y);
                }

                float noise(vec2 p) {
                    vec2 i = floor(p);
                    vec2 f = fract(p);
                    float a = hash(i);
                    float b = hash(i + vec2(1.0, 0.0));
                    float c = hash(i + vec2(0.0, 1.0));
                    float d = hash(i + vec2(1.0, 1.0));
                    vec2 u = f * f * (3.0 - 2.0 * f);
                    return mix(a, b, u.x) + (c - a) * u.y * (1.0 - u.x) + (d - b) * u.x * u.y;
                }

                float batikPattern(vec2 uv) {
                    uv *= 4.0;
                    vec2 gv = fract(uv) - 0.5;
                    vec2 id = floor(uv);
                    
                    float d = abs(gv.x + gv.y);
                    float mask = smoothstep(0.4, 0.38, d);
                    
                    float dist = length(gv);
                    float circle = smoothstep(0.3, 0.28, dist);
                    
                    return max(mask * 0.5, circle);
                }

                void main() {
                    vec2 uv = v_texCoord;
                    float aspect = u_resolution.x / u_resolution.y;
                    vec2 p = uv;
                    p.x *= aspect;
                    
                    float t = u_time * 0.15;
                    vec2 movement = vec2(sin(t * 0.5), cos(t * 0.3)) * 0.05;
                    p += movement;
                    
                    float layer1 = batikPattern(p * 1.5 + t * 0.1);
                    float layer2 = batikPattern(p * 2.5 - t * 0.05);
                    float texture = mix(layer1, layer2, 0.4);
                    
                    float n = noise(p * 10.0 + u_time * 0.05);
                    texture *= 0.8 + 0.2 * n;
                    
                    vec3 maroonDeep = vec3(0.345, 0.067, 0.102);
                    vec3 maroonLight = vec3(0.502, 0.0, 0.125); 
                    vec3 goldAccent = vec3(0.831, 0.686, 0.216);
                    
                    vec3 color = mix(maroonDeep, maroonLight, uv.y + sin(t) * 0.1);
                    
                    float shimmer = smoothstep(0.4, 0.6, texture) * (0.5 + 0.5 * sin(u_time + p.x * 5.0));
                    color = mix(color, goldAccent, shimmer * 0.15);
                    
                    float vignette = smoothstep(1.5, 0.5, length(uv - 0.5));
                    color *= 0.8 + 0.2 * vignette;

                    gl_FragColor = vec4(color, 1.0);
                }`;
                  function cs(type, src) {
                    const s = gl.createShader(type);
                    gl.shaderSource(s, src);
                    gl.compileShader(s);
                    return s;
                  }
                  const prog = gl.createProgram();
                  gl.attachShader(prog, cs(gl.VERTEX_SHADER, vs));
                  gl.attachShader(prog, cs(gl.FRAGMENT_SHADER, fs));
                  gl.linkProgram(prog);
                  gl.useProgram(prog);
                  const buf = gl.createBuffer();
                  gl.bindBuffer(gl.ARRAY_BUFFER, buf);
                  gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1,-1, 1,-1, -1,1, 1,1]), gl.STATIC_DRAW);
                  const pos = gl.getAttribLocation(prog, 'a_position');
                  gl.enableVertexAttribArray(pos);
                  gl.vertexAttribPointer(pos, 2, gl.FLOAT, false, 0, 0);
                  const uTime = gl.getUniformLocation(prog, 'u_time');
                  const uRes = gl.getUniformLocation(prog, 'u_resolution');
                  const uMouse = gl.getUniformLocation(prog, 'u_mouse');

                  let mouse = { x: canvas.width / 2, y: canvas.height / 2 };
                  window.addEventListener('mousemove', (event) => {
                    const rect = canvas.getBoundingClientRect();
                    if (rect.width && rect.height) {
                      const nx = (event.clientX - rect.left) / rect.width;
                      const ny = 1.0 - (event.clientY - rect.top) / rect.height;
                      mouse.x = nx * canvas.width;
                      mouse.y = ny * canvas.height;
                    }
                  });

                  function render(t) {
                    if (typeof ResizeObserver === 'undefined') syncSize();
                    gl.viewport(0, 0, canvas.width, canvas.height);
                    if (uTime) gl.uniform1f(uTime, t * 0.001);
                    if (uRes) gl.uniform2f(uRes, canvas.width, canvas.height);
                    if (uMouse) gl.uniform2f(uMouse, mouse.x, mouse.y);
                    gl.drawArrays(gl.TRIANGLE_STRIP, 0, 4);
                    requestAnimationFrame(render);
                  }
                  render(0);
                })();
                </script>
            </div>
            <div class="relative z-10">
                @yield('content')
            </div>
        </main>
    </body>
</html>
