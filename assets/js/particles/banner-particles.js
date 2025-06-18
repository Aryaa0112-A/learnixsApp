/**
 * Banner Particles Animation
 * Luxury effect for premium banner area
 */
document.addEventListener('DOMContentLoaded', function() {
    // Pastikan elemen particles ada di halaman
    const particlesContainer = document.getElementById('banner-particles');
    if (!particlesContainer) return;
    
    // Jumlah partikel yang akan dibuat
    const particleCount = 80;
    
    // Warna partikel
    const particleColors = [
        'rgba(255, 255, 255, 0.3)',
        'rgba(0, 114, 188, 0.4)',
        'rgba(255, 255, 255, 0.2)',
        'rgba(0, 114, 188, 0.3)',
        'rgba(255, 255, 255, 0.1)'
    ];
    
    // Buat partikel
    for (let i = 0; i < particleCount; i++) {
        createParticle(particlesContainer);
    }
    
    /**
     * Fungsi untuk membuat satu partikel
     * @param {HTMLElement} container - Container untuk partikel
     */
    function createParticle(container) {
        // Buat elemen partikel
        const particle = document.createElement('div');
        
        // Set style dasar
        particle.className = 'banner-particle';
        
        // Ukuran acak (2-6px)
        const size = Math.random() * 4 + 2;
        
        // Posisi acak
        const posX = Math.random() * 100;
        const posY = Math.random() * 100;
        
        // Kecepatan animasi acak (20-50s)
        const duration = Math.random() * 30 + 20;
        
        // Delay acak
        const delay = Math.random() * 5;
        
        // Warna acak dari array
        const colorIndex = Math.floor(Math.random() * particleColors.length);
        
        // Set style detail
        particle.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            background: ${particleColors[colorIndex]};
            border-radius: 50%;
            top: ${posY}%;
            left: ${posX}%;
            opacity: 0;
            filter: blur(${size > 4 ? 1 : 0}px);
            animation: float ${duration}s ease-in-out ${delay}s infinite;
            z-index: 1;
        `;
        
        // Tambahkan ke container
        container.appendChild(particle);
    }
    
    // Tambahkan style animasi ke head
    const style = document.createElement('style');
    style.innerHTML = `
        @keyframes float {
            0%, 100% {
                transform: translateY(0) translateX(0);
                opacity: 0;
            }
            10%, 90% {
                opacity: 1;
            }
            50% {
                transform: translateY(-${Math.random() * 30 + 20}px) translateX(${Math.random() * 20 - 10}px);
                opacity: 0.8;
            }
        }
    `;
    document.head.appendChild(style);
}); 