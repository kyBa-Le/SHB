export function loadWaiting() {
    const overlay = document.getElementById('loading-overlay');
    overlay.classList.add('active');
    window.onload = () => {
        overlay.classList.remove('active');
    };
}

export function hideWaiting() {
    const overlay = document.getElementById('loading-overlay');
    overlay.classList.remove('active');
}

export async function getData(path) {
    try {
        const response = await fetch(path); // Đợi fetch hoàn thành
        const data = await response.json(); // Đợi JSON được parse
        return (data);
    } catch (error) {
        console.error('Error fetching events:', error);
    }
}

export async function sendData(path, data) {
    loadWaiting();
    try {
        const response = await fetch(path, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const returnData = await response.json();
        return returnData;
    } catch (error) {
        console.error('Error occurred while sending data:', error);
        throw error;
    } finally {
        hideWaiting();
    }
}


export function moneyFormater(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}