const staticCacheName = "pwa-v1";
const filesToCache = [
    "/offline",
    "/images/pwa/apple-icon-180.png",
    "/images/pwa/favicon-196.png",
    "/images/pwa/manifest-icon-192.maskable.png",
    "/images/pwa/manifest-icon-512.maskable.png",
];

// Cache on install
self.addEventListener("install", event => {
    self.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(cacheNames
                .filter(cacheName => cacheName.startsWith("pwa-") && cacheName !== staticCacheName)
                .map(cacheName => caches.delete(cacheName)));
        })
    );
    self.clients.claim();
});

self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(error => {
                if (event.request.mode === "navigate") {
                    return caches.match("/offline");
                }

                throw error;
            })
    );
});