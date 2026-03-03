const CACHE_NAME = 'yakomayo-v1';
const urlsToCache = [
  './',
  './index.php',
  './css/estilos.css',
  './img/jaguar-solo.png'
];

// Instalar el Service Worker y guardar los archivos básicos
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        console.log('Archivos cacheados con éxito');
        return cache.addAll(urlsToCache);
      })
  );
});

// Interceptar las peticiones para que cargue rápido incluso sin buen internet
self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => {
        // Devuelve el archivo guardado, o si no lo tiene, lo busca en internet
        return response || fetch(event.request);
      })
  );
});