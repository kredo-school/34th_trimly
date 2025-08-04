 // DOMが完全に読み込まれた後に実行
    document.addEventListener('DOMContentLoaded', function() {
        // ===========================================
        // 「Add Pet」機能のJavaScriptコード
        // ===========================================
        let petCount = 1; // 最初に表示されているペットがPet 1なので、次の追加はPet 2から
        const addPetButton = document.querySelector('.btn-add-pet');
        const petCardsContainer = document.getElementById('petCardsContainer');

        // ★削除ボタンのイベントリスナーを設定する関数
        function attachDeleteListeners() {
            // 現在DOMに存在する全ての削除ボタンを取得
            const deleteButtons = document.querySelectorAll('.delete-pet-button');
            deleteButtons.forEach(button => {
                // 既にイベントリスナーが追加されていないか確認 (多重登録防止)
                if (!button.dataset.listenerAttached) {
                    button.addEventListener('click', function() {
                        const targetCardId = this.dataset.targetCard; // data-target-card属性から対象のカードIDを取得
                        const targetCard = document.getElementById(targetCardId); // カード要素を取得

                        // カードが存在すれば削除
                        if (targetCard) {
                            targetCard.remove(); // カードをDOMから削除

                            // ★削除後にペット番号を再採番し、IDとname属性も更新
                            updatePetNumbers();
                        }
                    });
                    // イベントリスナーが追加されたことを示すフラグを設定
                    button.dataset.listenerAttached = 'true'; 
                }
            });
        }

        // ★ペット番号と関連ID/name属性を更新する関数
        function updatePetNumbers() {
            const petCards = document.querySelectorAll('.pet-card'); // 現在DOMに残っている全てのペットカードを取得
            petCards.forEach((card, index) => {
                const newPetNumber = index + 1; // 新しいペット番号 (1から始まる)

                // 1. Pet N の表示を更新 (例: Pet 1, Pet 2)
                const h5Element = card.querySelector('h5');
                if (h5Element) {
                    h5Element.textContent = `Pet ${newPetNumber}`;
                }

                // 2. カード自体のIDを更新
                card.id = `petCard${newPetNumber}`;

                // 3. 削除ボタンのdata-target-card属性を更新 (これがないと削除が正しく機能しなくなる)
                const deleteButton = card.querySelector('.delete-pet-button');
                if (deleteButton) {
                    deleteButton.dataset.targetCard = `petCard${newPetNumber}`;
                }

                // 4. 各入力フィールドのIDとfor属性、name属性を更新
                // ここでは、入力フィールドのname属性は pets[][...] で送信するので、
                // インデックス部分 (pets[0], pets[1]など) はPHPに任せるため変更しません。
                // ただし、IDとfor属性はユニークであるべきなので更新します。
                card.querySelectorAll('[id^="petName"], [id^="breed"], [id^="age"], [id^="weight"], [id^="gender"], [id^="specialNotes"]').forEach(input => {
                    const originalId = input.id;
                    // 元のIDからフィールド名（例: petName, breed）を抽出
                    const fieldName = originalId.match(/[a-zA-Z]+/)[0]; 

                    // 新しいIDを設定
                    input.id = `${fieldName}${newPetNumber}`;

                    // labelのfor属性も更新
                    const label = card.querySelector(`label[for="${originalId}"]`);
                    if (label) {
                        label.setAttribute('for', `${fieldName}${newPetNumber}`);
                    }
                });
            });
            // 現在のペットの総数を更新
            petCount = petCards.length; 
        }


        // 「Add Pet」ボタンとコンテナがHTML上に存在することを確認
        if (addPetButton && petCardsContainer) {
            addPetButton.addEventListener('click', function() {
                petCount++; // ペットの数を1増やす (Pet 2, Pet 3, ...)

                // 追加する新しいペットフォームのHTML文字列
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
                                <label for="petName${petCount}" class="form-label text-muted">Pet Name <span class="text-danger">*</span></label>
                                <div class="input-group input-group-custom">
                                    <input type="text" class="form-control" id="petName${petCount}" name="pets[][pet_name]" placeholder="Enter pet's name" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 text-start">
                                <label for="breed${petCount}" class="form-label text-muted">Breed <span class="text-danger">*</span></label>
                                <div class="input-group input-group-custom">
                                    <input type="text" class="form-control" id="breed${petCount}" name="pets[][breed]" placeholder="Enter breed" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 text-start">
                                <label for="age${petCount}" class="form-label text-muted">Age <span class="text-danger">*</span></label>
                                <div class="input-group input-group-custom">
                                    <select class="form-select form-control" id="age${petCount}" name="pets[][age]" required>
                                        <option selected disabled value="">Select age</option>
                                        <option>0-1 year</option>
                                        <option>1-3 years</option>
                                        <option>3-7 years</option>
                                        <option>7+ years</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 text-start">
                                <label for="weight${petCount}" class="form-label text-muted">Weight <span class="text-danger">*</span></label>
                                <div class="input-group input-group-custom">
                                    <select class="form-select form-control" id="weight${petCount}" name="pets[][weight]" required>
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
                            <label for="gender${petCount}" class="form-label text-muted">Gender <span class="text-danger">*</span></label>
                            <div class="input-group input-group-custom">
                                <select class="form-select form-control" id="gender${petCount}" name="pets[][gender]" required>
                                    <option selected disabled value="">Select gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Unknown</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 text-start">
                            <label for="specialNotes${petCount}" class="form-label text-muted">Special Needs or Notes</label>
                            <div class="input-group input-group-custom">
                                <textarea class="form-control" id="specialNotes${petCount}" name="pets[][special_notes]" rows="3" placeholder="Any special care instructions, behavioral notes, medical conditions, etc."></textarea>
                            </div>
                        </div>
                    </div>
                `;
                // 生成したHTMLをpetCardsContainerの末尾に追加
                petCardsContainer.insertAdjacentHTML('beforeend', newPetCardHtml);
                // 新しく追加された要素にもイベントリスナーを設定
                attachDeleteListeners(); 
            });
        }

        // ページロード時に既存のPet 1の削除ボタンにもイベントリスナーを設定
        attachDeleteListeners(); 
    }); // DOMContentLoadedの閉じ