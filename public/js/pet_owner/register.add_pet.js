document.addEventListener('DOMContentLoaded', function() {
    const addPetButton = document.querySelector('.btn-add-pet');
    const petCardsContainer = document.getElementById('petCardsContainer');

    let petCount = 1; // 最初のPetカードが1

    function attachDeleteListeners() {
        const deleteButtons = document.querySelectorAll('.delete-pet-button');
        deleteButtons.forEach(button => {
            if (!button.dataset.listenerAttached) {
                button.addEventListener('click', function() {
                    const targetCardId = this.dataset.targetCard;
                    const targetCard = document.getElementById(targetCardId);
                    if (targetCard) {
                        targetCard.remove();
                        updatePetNumbers();
                        if (document.querySelectorAll('.pet-card').length === 1) {
                            const firstDeleteButton = document.querySelector('.pet-card:first-child .delete-pet-button');
                            if (firstDeleteButton) firstDeleteButton.style.display = 'none';
                        }
                    }
                });
                button.dataset.listenerAttached = 'true';
            }
        });
    }

    function updatePetNumbers() {
        const petCards = document.querySelectorAll('.pet-card');
        petCards.forEach((card, index) => {
            const newPetNumber = index + 1;

            card.id = `petCard${newPetNumber}`;
            const deleteButton = card.querySelector('.delete-pet-button');
            if (deleteButton) deleteButton.dataset.targetCard = card.id;

            // ペット番号表示
            const h5Element = card.querySelector('h5');
            if (h5Element) h5Element.textContent = `Pet ${newPetNumber}`;

            // 入力IDとラベルforを更新
            const fields = ['petName', 'breed', 'age', 'weight', 'gender', 'specialNotes'];
            fields.forEach(field => {
                const input = card.querySelector(`#${field}${newPetNumber}`);
                const label = card.querySelector(`label[for^="${field}"]`);
                if (input) input.id = `${field}${newPetNumber}`;
                if (label) label.setAttribute('for', `${field}${newPetNumber}`);
            });

            // name属性も更新してLaravel配列に対応
            card.querySelectorAll('input, select, textarea').forEach(el => {
                const fieldName = el.id.replace(/[0-9]+$/, '');
                switch(fieldName) {
                    case 'petName':
                        el.name = `pets[${index}][pet_name]`; break;
                    case 'breed':
                        el.name = `pets[${index}][breed]`; break;
                    case 'age':
                        el.name = `pets[${index}][age]`; break;
                    case 'weight':
                        el.name = `pets[${index}][weight]`; break;
                    case 'gender':
                        el.name = `pets[${index}][gender]`; break;
                    case 'specialNotes':
                        el.name = `pets[${index}][special_notes]`; break;
                }
            });
        });
        petCount = petCards.length;
    }

    if (addPetButton && petCardsContainer) {
        addPetButton.addEventListener('click', function() {
            petCount++;

            // 最初のカードの削除ボタン非表示
            const firstDeleteButton = document.querySelector('.pet-card:first-child .delete-pet-button');
            if (firstDeleteButton) firstDeleteButton.style.display = 'flex'; // 修正: 2つ目以降のカードが追加されたら表示

            const newIndex = petCount - 1;
            const newPetCardHtml = `
                <div class="pet-card" id="petCard${petCount}">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-muted mb-0">Pet ${petCount}</h5>
                        <button type="button" class="btn btn-sm btn-outline-danger delete-pet-button" data-target-card="petCard${petCount}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3 text-start">
                            <label for="petName${petCount}" class="form-label">Pet Name <span class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                <input type="text" class="form-control" id="petName${petCount}" name="pets[${newIndex}][pet_name]" placeholder="Enter pet's name" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 text-start">
                            <label for="breed${petCount}" class="form-label">Breed <span class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                <input type="text" class="form-control" id="breed${petCount}" name="pets[${newIndex}][breed]" placeholder="Enter breed" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3 text-start">
                            <label for="age${petCount}" class="form-label">Age <span class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                <select class="form-select form-control" id="age${petCount}" name="pets[${newIndex}][age]" required>
                                    <option selected disabled value="">Select age</option>
                                    <option>0-1 year</option>
                                    <option>1-3 years</option>
                                    <option>3-7 years</option>
                                    <option>7+ years</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 text-start">
                            <label for="weight${petCount}" class="form-label">Weight <span class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                <select class="form-select form-control" id="weight${petCount}" name="pets[${newIndex}][weight]" required>
                                    <option selected disabled value="">Select weight range</option>
                                    <option>0-5 kg</option>
                                    <option>5-10 kg</option>
                                    <option>10-20 kg</option>
                                    <option>20+ kg</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="gender${petCount}" class="form-label">Gender <span class="text-danger">*</span></label>
                        <div class="input-group input-group-custom">
                            <select class="form-select form-control" id="gender${petCount}" name="pets[${newIndex}][gender]" required>
                                <option selected disabled value="">Select gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Unknown</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="specialNotes${petCount}" class="form-label">Special Needs or Notes</label>
                        <div class="input-group input-group-custom">
                            <textarea class="form-control" id="specialNotes${petCount}" name="pets[${newIndex}][special_notes]" rows="3" placeholder="Any special care instructions, behavioral notes, medical conditions, etc."></textarea>
                        </div>
                    </div>
                </div>
            `;
            petCardsContainer.insertAdjacentHTML('beforeend', newPetCardHtml);
            attachDeleteListeners();
        });
    }

    attachDeleteListeners();

    const form = document.querySelector("form");
    const continueBtn = document.getElementById("continueBtn");

    if (form && continueBtn) {
        // 初期状態を無効化
        continueBtn.disabled = true;

        form.addEventListener("input", function () {
            let allFilled = true;

            form.querySelectorAll("input[required], select[required]").forEach(function (input) {
                if (!input.value.trim()) {
                    allFilled = false;
                }
            });

            continueBtn.disabled = !allFilled;
        });
    }
});