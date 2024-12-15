export function loadWaiting() {
    const overlay = document.getElementById('loading-overlay');
    overlay.classList.add('active');
    window.onload = () => {
        overlay.classList.remove('active');
    };
}

export function moneyFormater(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}