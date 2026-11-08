<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: loggingIn.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Stageplan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .grid-bg {
            background-size: 20px 20px;
            background-image:
                linear-gradient(to right, rgba(0, 0, 0, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.05) 1px, transparent 1px);
        }
        /* Verhindert das Scrollen der gesamten Seite */
        html, body {
            touch-action: none;
            -webkit-user-select: none;
            user-select: none;
        }
        /* Erlaubt unbegrenztes Scrollen in der Drag-Zone */
        #stage-container {
            overflow: auto;
            touch-action: pan-x pan-y;
            scroll-behavior: smooth;
        }
        .scroll-safe {
            touch-action: pan-y !important;
        }
    </style>
</head>

<body class="bg-[#f0f2f5] h-screen flex flex-col overflow-hidden font-sans">

    <header class="bg-[#d1d9e6] p-4 flex justify-between items-center shadow-sm z-20">
        <div>
            <h1 class="text-2xl font-normal text-black leading-tight">Stageplan</h1>
            <p class="text-sm text-gray-600">Bühnenplaner</p>
        </div>
        
        <div class="flex items-center gap-2 bg-white/50 px-3 py-1.5 rounded border border-gray-300">
            <span class="text-xs font-semibold text-gray-700">Bühnengröße:</span>
            <input id="zoom-slider" type="range" min="0.5" max="2" step="0.1" value="1" class="w-24 md:w-32 accent-blue-600">
            <span id="zoom-val" class="text-xs text-gray-600 min-w-[35px] text-right">100%</span>
        </div>

        <div class="flex gap-2">
            <button id="toggle-sidebar" class="md:hidden bg-gray-600 text-white px-4 py-2 rounded shadow-sm text-sm">
                Inventar ☰
            </button>
            <button id="clear-stage"
                class="bg-red-500 text-white px-6 py-2 rounded shadow-sm hover:bg-red-600 min-h-[44px]">
                Alles löschen
            </button>

            <a class="bg-[#8ba4bc] text-black px-6 py-2 rounded shadow-sm hover:bg-[#7a93ab] min-h-[44px] flex items-center"
                href="navigation.php">Zurück</a>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden relative">

        <aside id="sidebar" class="w-64 bg-white border-r border-gray-300 flex flex-col shadow-lg z-10 absolute md:relative h-full transition-transform duration-300 transform translate-x-0">
            <div class="p-4 border-b bg-gray-50 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Inventar</div>

            <div class="p-6 space-y-8 overflow-y-auto flex-1 scroll-safe">
                <div class="asset-btn group cursor-pointer p-2 bg-gray-50 rounded border border-gray-200 active:scale-95 transition-transform" data-type="quer" data-w="160">
                    <p class="text-[10px] text-gray-500 mb-2 uppercase text-center italic">Querformat</p>
                    <img src="img/BuehnenteilQuer.jpg" alt="Quer" class="w-full h-auto rounded pointer-events-none">
                </div>

                <div class="asset-btn group cursor-pointer p-2 bg-gray-50 rounded border border-gray-200 active:scale-95 transition-transform" data-type="hoch" data-w="80">
                    <p class="text-[10px] text-gray-500 mb-2 uppercase text-center italic">Hochkant</p>
                    <img src="img/BuehnenteilLaengs.jpg" alt="Hoch" class="w-20 mx-auto h-auto rounded pointer-events-none">
                </div>

                <div class="asset-btn group cursor-pointer p-2 bg-gray-50 rounded border border-gray-200 active:scale-95 transition-transform" data-type="sub" data-w="80">
                    <p class="text-[10px] text-gray-500 mb-2 uppercase text-center italic">Subwoofer</p>
                    <img src="img/Subwoofer.jpg" alt="Sub" class="w-20 mx-auto h-auto rounded pointer-events-none">
                </div>

                <div class="asset-btn group cursor-pointer p-2 bg-gray-50 rounded border border-gray-200 active:scale-95 transition-transform" data-type="hochton" data-w="80">
                    <p class="text-[10px] text-gray-500 mb-2 uppercase text-center italic">Top</p>
                    <img src="img/Hochtoner.jpg" alt="hochton" class="w-20 mx-auto h-auto rounded pointer-events-none">
                </div>
                
                <div class="asset-btn group cursor-pointer p-2 bg-gray-50 rounded border border-gray-200 active:scale-95 transition-transform" data-type="bildschirm" data-w="80">
                    <p class="text-[10px] text-gray-500 mb-2 uppercase text-center italic">Bildschirm</p>
                    <img src="img/bildschirm.png" alt="Mischpult" class="w-20 mx-auto h-auto rounded pointer-events-none">
                </div>
                
                <div class="asset-btn group cursor-pointer p-2 bg-gray-50 rounded border border-gray-200 active:scale-95 transition-transform" data-type="monitor" data-w="80">
                    <p class="text-[10px] text-gray-500 mb-2 uppercase text-center italic">Monitorbox</p>
                    <img src="img/monitor_2.png" alt="Mischpult" class="w-20 mx-auto h-auto rounded pointer-events-none">
                </div>
                
                <div class="asset-btn group cursor-pointer p-2 bg-gray-50 rounded border border-gray-200 active:scale-95 transition-transform" data-type="stagebox" data-w="80">
                    <p class="text-[10px] text-gray-500 mb-2 uppercase text-center italic">Stagebox</p>
                    <img src="img/stagebox.png" alt="Mischpult" class="w-20 mx-auto h-auto rounded pointer-events-none">
                </div>
                
                <div class="asset-btn group cursor-pointer p-2 bg-gray-50 rounded border border-gray-200 active:scale-95 transition-transform" data-type="mischpult" data-w="80">
                    <p class="text-[10px] text-gray-500 mb-2 uppercase text-center italic">Mischpult</p>
                    <img src="img/mischpult.png" alt="Mischpult" class="w-20 mx-auto h-auto rounded pointer-events-none">
                </div>
                
                <div class="asset-btn group cursor-pointer p-2 bg-gray-50 rounded border border-gray-200 active:scale-95 transition-transform" data-type="treppe_links" data-w="80">
                    <p class="text-[10px] text-gray-500 mb-2 uppercase text-center italic">Treppe Links</p>
                    <img src="img/treppe_links.png" alt="Mischpult" class="w-20 mx-auto h-auto rounded pointer-events-none">
                </div>
                
                <div class="asset-btn group cursor-pointer p-2 bg-gray-50 rounded border border-gray-200 active:scale-95 transition-transform" data-type="treppe_rechts" data-w="80">
                    <p class="text-[10px] text-gray-500 mb-2 uppercase text-center italic">Treppe Rechts</p>
                    <img src="img/treppe_rechts.png" alt="Mischpult" class="w-20 mx-auto h-auto rounded pointer-events-none">
                </div>
                
                <div class="asset-btn group cursor-pointer p-2 bg-gray-50 rounded border border-gray-200 active:scale-95 transition-transform" data-type="treppe" data-w="80">
                    <p class="text-[10px] text-gray-500 mb-2 uppercase text-center italic">Treppe</p>
                    <img src="img/treppe.png" alt="Mischpult" class="w-20 mx-auto h-auto rounded pointer-events-none">
                </div>
            </div>

            <div class="mt-auto p-4 text-[11px] text-gray-500 text-center bg-gray-50 border-t"></div>
        </aside>

        <div id="stage-container" class="flex-1 h-full w-full relative bg-[#e5e7eb]">
            <main id="drop-zone" class="absolute bg-white grid-bg origin-top-left" style="width: 5000px; height: 5000px; left: 0; top: 0;"></main>
        </div>

    </div>

    <script>
    function share(){
        window.location.assign("shaere/shaere.php");
    }
    </script>

    <script>
        const stageContainer = document.getElementById('stage-container');
        const dropZone = document.getElementById('drop-zone');
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggle-sidebar');
        const zoomSlider = document.getElementById('zoom-slider');
        const zoomVal = document.getElementById('zoom-val');
        const gridSize = 20;
        let currentZoom = 1;

        // Zentriert die Ansicht auf der unendlich großen Arbeitsfläche beim Start
        function centerStage() {
            const startX = (4000 - stageContainer.clientWidth) / 2;
            const startY = (4000 - stageContainer.clientHeight) / 2;
            stageContainer.scrollLeft = startX;
            stageContainer.scrollTop = startY;
        }

        // Zoom-Logik angepasst für die feste, große Pixelgröße
        zoomSlider.addEventListener('input', (e) => {
            currentZoom = parseFloat(e.target.value);
            zoomVal.textContent = Math.round(currentZoom * 100) + '%';
            
            // Transformiert die gesamte 5000px Fläche per CSS Scale
            dropZone.style.transform = `scale(${currentZoom})`;
        });

        // Sidebar-Toggle
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('translate-x-0');
            sidebar.classList.toggle('-translate-x-full');
        });

        // LOCAL STORAGE LOGIK: Speichern
        function saveStageToLocalStorage() {
            const elements = [];
            dropZone.querySelectorAll('.stage-element').forEach(el => {
                elements.push({
                    src: el.getAttribute('data-src'),
                    x: parseInt(el.style.left, 10),
                    y: parseInt(el.style.top, 10),
                    width: parseInt(el.style.width, 10)
                });
            });
            localStorage.setItem('stageplan_data', JSON.stringify(elements));
        }

        // LOCAL STORAGE LOGIK: Laden
        function loadStageFromLocalStorage() {
            const savedData = localStorage.getItem('stageplan_data');
            if (savedData) {
                const elements = JSON.parse(savedData);
                elements.forEach(item => {
                    createStageElement(item.src, item.x, item.y, item.width);
                });
            }
        }

        // LOGIK 1: NEUE ELEMENTE AUS DER SIDEBAR ZIEHEN
        document.querySelectorAll('.asset-btn').forEach(btn => {
            btn.addEventListener('pointerdown', (e) => {
                const startX = e.clientX;
                const startY = e.clientY;
                let isDragging = false;
                let ghost = null;

                const width = parseInt(btn.getAttribute('data-w'), 10);
                const imgUrl = btn.querySelector('img').src;

                const onPointerMove = (moveEvent) => {
                    if (moveEvent.pointerId !== e.pointerId) return;

                    const diffX = moveEvent.clientX - startX;
                    const diffY = moveEvent.clientY - startY;

                    if (!isDragging) {
                        if (Math.abs(diffY) > Math.abs(diffX) && Math.abs(diffY) > 5) {
                            cleanup();
                            return;
                        }
                        if (Math.abs(diffX) > 8 || Math.abs(diffY) > 8) {
                            isDragging = true;
                            moveEvent.preventDefault();

                            ghost = document.createElement('div');
                            ghost.className = 'fixed unselectable pointer-events-none z-[9999]';
                            ghost.style.width = (width * currentZoom) + 'px';
                            
                            const img = document.createElement('img');
                            img.src = imgUrl;
                            img.className = 'w-full h-auto opacity-75 rounded border-2 border-blue-500 shadow-xl';
                            ghost.appendChild(img);
                            document.body.appendChild(ghost);
                            
                            btn.setPointerCapture(e.pointerId);
                        }
                    }

                    if (isDragging && ghost) {
                        ghost.style.left = (moveEvent.clientX - (width * currentZoom) / 2) + 'px';
                        ghost.style.top = (moveEvent.clientY - 35) + 'px';
                    }
                };

                const onPointerUp = (upEvent) => {
                    if (upEvent.pointerId !== e.pointerId) return;
                    cleanup();

                    if (isDragging) {
                        const rect = stageContainer.getBoundingClientRect();
                        
                        // Prüfen, ob über dem Container losgelassen wurde
                        if (upEvent.clientX >= rect.left && upEvent.clientX <= rect.right &&
                            upEvent.clientY >= rect.top && upEvent.clientY <= rect.bottom) {
                            
                            // WICHTIG: Scrollposition des Containers hinzurechnen, um die genaue Canvas-Koordinate zu treffen
                            const canvasX = (upEvent.clientX - rect.left + stageContainer.scrollLeft) / currentZoom;
                            const canvasY = (upEvent.clientY - rect.top + stageContainer.scrollTop) / currentZoom;

                            let snapX = Math.round((canvasX - width / 2) / gridSize) * gridSize;
                            let snapY = Math.round((canvasY - 35 / currentZoom) / gridSize) * gridSize;

                            // Grenzen auf die 5000px Fläche limitieren
                            snapX = Math.max(0, Math.min(snapX, 5000 - width));
                            snapY = Math.max(0, Math.min(snapY, 5000 - 40));

                            createStageElement(imgUrl, snapX, snapY, width);
                            saveStageToLocalStorage();
                        }

                        if (window.innerWidth < 768) {
                            sidebar.classList.add('-translate-x-full');
                            sidebar.classList.remove('translate-x-0');
                        }
                    }
                };

                function cleanup() {
                    btn.removeEventListener('pointermove', onPointerMove);
                    btn.removeEventListener('pointerup', onPointerUp);
                    try { btn.releasePointerCapture(e.pointerId); } catch(err) {}
                    if (ghost) {
                        ghost.remove();
                        ghost = null;
                    }
                }

                btn.addEventListener('pointermove', onPointerMove);
                btn.addEventListener('pointerup', onPointerUp);
            });
        });

        // LOGIK 2: ELEMENTE AUF DER BÜHNE ERSTELLEN & BEWEGEN
        function createStageElement(src, x, y, width) {
            const el = document.createElement('div');
            el.className = 'stage-element absolute cursor-move select-none touch-none group active:scale-[1.02] transition-transform duration-200';
            el.style.left = x + 'px';
            el.style.top = y + 'px';
            el.style.width = width + 'px';
            el.setAttribute('data-src', src);

            const img = document.createElement('img');
            img.src = src;
            img.className = 'w-full h-auto pointer-events-none rounded border border-gray-300 shadow-sm group-hover:ring-2 group-hover:ring-blue-500';
            el.appendChild(img);

            const touchArea = document.createElement('div');
            touchArea.className = 'absolute -inset-3 rounded-lg -z-10';
            el.appendChild(touchArea);

            const deleteBtn = document.createElement('button');
            deleteBtn.innerHTML = '✕';
            deleteBtn.className = 'absolute -top-3 -right-3 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold shadow opacity-100 md:opacity-0 group-hover:opacity-100 transition-opacity z-30';
            deleteBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                el.remove();
                saveStageToLocalStorage();
            });
            el.appendChild(deleteBtn);

            let isDragging = false;
            let startX, startY;

            el.addEventListener('pointerdown', (e) => {
                if (e.target === deleteBtn) return;
                e.preventDefault();
                
                isDragging = true;
                el.setPointerCapture(e.pointerId);
                
                const rect = el.getBoundingClientRect();
                startX = (e.clientX - rect.left) / currentZoom;
                startY = (e.clientY - rect.top) / currentZoom;
                
                el.style.zIndex = 1000;
            });

            el.addEventListener('pointermove', (e) => {
                if (!isDragging) return;
                
                const zoneRect = dropZone.getBoundingClientRect();
                
                let newX = ((e.clientX - zoneRect.left) / currentZoom) - startX;
                let newY = ((e.clientY - zoneRect.top) / currentZoom) - startY;
                
                // Grenzen auf die feste 5000px Größe umstellen
                const maxW = 5000 - el.offsetWidth;
                const maxH = 5000 - el.offsetHeight;

                newX = Math.max(0, Math.min(newX, maxW));
                newY = Math.max(0, Math.min(newY, maxH));
                
                el.style.left = newX + 'px';
                el.style.top = newY + 'px';
            });

            el.addEventListener('pointerup', (e) => {
                if (!isDragging) return;
                isDragging = false;
                el.releasePointerCapture(e.pointerId);
                
                const containerRect = stageContainer.getBoundingClientRect();

                // Wenn man das Element ganz aus dem Scroll-Fenster wirft, löschen
                if (e.clientX < containerRect.left || e.clientX > containerRect.right ||
                    e.clientY < containerRect.top || e.clientY > containerRect.bottom) {
                    el.remove();
                    saveStageToLocalStorage();
                    return;
                }
                
                let finalX = Math.round(el.offsetLeft / gridSize) * gridSize;
                let finalY = Math.round(el.offsetTop / gridSize) * gridSize;
                
                el.style.left = finalX + 'px';
                el.style.top = finalY + 'px';
                el.style.zIndex = '';
                
                saveStageToLocalStorage();
            });

            dropZone.appendChild(el);
            return el;
        }

        window.addEventListener('DOMContentLoaded', () => {
            loadStageFromLocalStorage();
            centerStage(); // Start-Fokus in die Mitte setzen
        });
        
        const clearStageBtn = document.getElementById('clear-stage');
        clearStageBtn.addEventListener('click', () => {
            if (!confirm('Möchtest du wirklich alle Elemente entfernen?')) {
                return;
            }
            dropZone.querySelectorAll('.stage-element').forEach(el => {
                el.remove();
            });
            localStorage.removeItem('stageplan_data');
        });
    </script>
</body>

</html> 