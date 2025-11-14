// public/service-worker.js

self.addEventListener("install", event => {
    console.log("Service Worker instalado");
    // Aqui você poderia usar caches.open() para cachear arquivos se quiser
});

self.addEventListener("activate", event => {
    console.log("Service Worker ativado");
});

self.addEventListener("fetch", event => {
    // Aqui dá pra interceptar requisições e servir cache, se quiser
    // event.respondWith(...)
});
