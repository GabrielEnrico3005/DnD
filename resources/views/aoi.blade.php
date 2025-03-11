@extends('layouts.app')

@section('title', 'Aoi Page')

@section('content')
    <img src="{{ asset('storage/img/Gavin.png') }}" alt="Profile Image">
    <div class="info">
        <h2>Aoi</h2>
        <input type="range" min="0" max="10" value="5" class="slider" id="ratingSlider">
        <p>Mana: <span id="sliderValue" style="font-weight: bold; color: #ff7e5f;">5</span></p>

        <h3>Skill:</h3>
        <div class="button-group">
            <button class="skill-btn skill_1" onclick="addPoints(2)">Cerulean Devil "Devil Strike"</button>
            <br>
            <button class="skill-btn skill_2" onclick="attemptSubtractPoints(2)">Cerulean Devil "Sonic Burst"</button>
        </div>

        <div id="warningBox" class="warning-box" style="display: none;">
            <h3>⚠ Warning List ⚠</h3>
            <h3>You are Exhausted</h3>
            <ol id="warningList" class="negative-list"></ol>
        </div>

        <!-- Modal untuk warning -->
        <div id="popupModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <h3>⚠ Warning!</h3>
                <h3>Are you sure you want to do mana overload?</h3>
                <p id="popupMessage"></p>
                <div class="modal-buttons">
                    <button id="confirmButton" class="btn-confirm">Continue</button>
                    <button id="cancelButton" class="btn-cancel">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let manaValueAoi = 5;
        let pendingSubtraction = 0;
        const slider = document.getElementById("ratingSlider");
        const output = document.getElementById("sliderValue");
        const warningBox = document.getElementById("warningBox");
        const warningList = document.getElementById("warningList");
        const confirmButton = document.getElementById("confirmButton");
        const cancelButton = document.getElementById("cancelButton");
        const popupModal = document.getElementById("popupModal");
    
        slider.oninput = function () {
            if (manaValueAoi >= 0) {
                manaValueAoi = parseInt(this.value);
                updateManaUI();
            } else {
                slider.value = 0;
            }
        };
    
        function addPoints(points) {
            manaValueAoi = Math.min(manaValueAoi + points, 10);
            updateManaUI();
        }
    
        function attemptSubtractPoints(points) {
            if (manaValueAoi - points < 0) {
                pendingSubtraction = points;
                showPopup();
            } else {
                subtractPointsDirectly(points);
            }
        }

        function subtractPointsDirectly(points) {
            manaValueAoi = Math.max(manaValueAoi - points, -10);
            updateManaUI();
        }

        function subtractPoints() {
            if (!isNaN(pendingSubtraction)) {
                manaValueAoi = Math.max(manaValueAoi - pendingSubtraction, -10);
                updateManaUI();
            }
            closePopup();
        }

    
        function updateManaUI() {
            slider.value = manaValueAoi >= 0 ? manaValueAoi : 0;
            output.textContent = manaValueAoi;
            updateTextColor(manaValueAoi);
            checkWarning(manaValueAoi);
            localStorage.setItem("manaValueAoi", manaValueAoi);
    
            if (manaValueAoi < 0) {
                slider.disabled = true;
            } else {
                slider.disabled = false;
            }
        }
    
        function checkWarning(value) {
            warningList.innerHTML = "";
    
            if (value <= -1) addWarning("😓 Half Your Speed");
            if (value <= -2) addWarning("🎲 Roll Disadvantage!");
            if (value <= -3) addWarning("💀 HP berkurang setengah!");
            if (value <= -5) addWarning("🔥 Critical Weakness!");
            if (value <= -7) addWarning("🛑 Unconscious State!");
            if (value <= -10) addWarning("☠ Total Exhaustion!");
    
            warningBox.style.display = value < 0 ? "block" : "none";
        }
    
        function showPopup() {
            popupModal.style.display = "flex";
        }
    
        function closePopup() {
            popupModal.style.display = "none";
        }
    
        function addWarning(text) {
            let listItem = document.createElement("li");
            listItem.textContent = text;
            warningList.appendChild(listItem);
        }
    
        function updateTextColor(value) {
            output.style.transition = "color 0.3s ease-in-out";
            output.style.color = value >= 7 ? "#2ecc71" : value <= 3 ? "#e74c3c" : "#ff7e5f";
        }
    
        confirmButton.onclick = function () {
            subtractPoints();
        };
    
        cancelButton.onclick = function () {
            closePopup();
        };
    
        document.addEventListener("DOMContentLoaded", function () {
            manaValueAoi = localStorage.getItem("manaValueAoi") !== null ? parseInt(localStorage.getItem("manaValueAoi")) : 5;
            updateManaUI();
            closePopup();
        });
    </script>
    <style>
        .button-group {
            display: flex;
            flex-direction: column; 
            gap: 10px; 
            margin-top: 10px;
            width: 100%;
            align-items: center; 
        }

        .skill-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            width: 200px; 
            text-align: center;
        }

        .skill_1 {
            background-color: #ff7e5f;
            color: white;
        }

        .skill_2 {
            background-color: #e74c3c;
            color: white;
        }

        .skill-btn:hover {
            opacity: 0.8;
        }

        .warning-box {
            margin-top: 20px;
            padding: 10px;
            background: #ffcccc;
            border: 2px solid #ff4d4d;
            border-radius: 5px;
            color: #900;
            max-width: 250px;
        }

        .negative-list {
            padding-left: 20px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            max-width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease-in-out;
        }

        .modal h3 {
            color: #e74c3c;
        }

        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
        }

        .btn-confirm {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-cancel {
            background: gray;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-confirm:hover {
            background: #c0392b;
        }

        .btn-cancel:hover {
            background: #777;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
@endsection
