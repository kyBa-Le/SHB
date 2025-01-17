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

export async function sendData(path, data, isDisplayWaiting = true) {
    if (isDisplayWaiting) {
        loadWaiting();
    }
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

export async function updateData (path, data, isDisplayWaiting = false) {
    if (isDisplayWaiting) {
        loadWaiting();
    }
    try {
        const response = await fetch(path, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return await response.json();
    } catch (error) {
        console.error('Error occurred while sending data:', error);
        throw error;
    } finally {
        hideWaiting();
    }
}

export async function patchData (path, data, isDisplayWaiting = false) {
    if (isDisplayWaiting) {
        loadWaiting();
    }
    try {
        const response = await fetch(path, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return await response.json();
    } catch (error) {
        console.error('Error occurred while sending data:', error);
        throw error;
    } finally {
        hideWaiting();
    }
}

export async function deleteData (path, data = null, isDisplayWaiting = false) {
    if (isDisplayWaiting) {
        loadWaiting();
    }
    try {
        const response = await fetch(path, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return await response.json();
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

export function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

export function redirectToPost(url, data) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = url;
    form.style.display = 'none';
    for (const key in data) {
        if (data.hasOwnProperty(key)) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = data[key];
            form.appendChild(input);
        }
    }
    document.body.appendChild(form);
    form.submit();
}