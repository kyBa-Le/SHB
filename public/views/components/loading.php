<style>

    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        z-index: 10;
    }

    .loading-overlay.active {
        display: flex;
    }

    .loading-logo {
        width: 100px;
        height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        animation: loading-bounce 1.5s infinite;
    }

    .loading-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .loading-text {
        margin-top: 10px;
        font-size: 18px;
        color: #fff;
        font-family: Arial, sans-serif;
        animation: loading-dots 1.5s infinite;
    }

    @keyframes loading-dots {
        0% {
            content: "";
        }
        33% {
            content: ".";
        }
        66% {
            content: "..";
        }
        100% {
            content: "...";
        }
    }

    @keyframes loading-bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-30px);
        }
        60% {
            transform: translateY(-15px);
        }
    }
</style>
<div class="loading-overlay" id="loading-overlay">
    <div class="loading-logo">
        <img src="images/logo.png" alt="Logo">
    </div>
    <div class="loading-text">Loading<span class="loading-dots">...</span></div>
</div>

