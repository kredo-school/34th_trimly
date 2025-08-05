
/**
 * Copy salon code to clipboard
 * Shows success message and handles fallback for older browsers
 */
function copyCode() {
    const code = 'G1P441219';
    
    // Try modern clipboard API first
    navigator.clipboard.writeText(code).then(() => {
        // Update button to show success
        const btn = document.querySelector('.owner-copy-btn');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-check"></i> Copied!';
        btn.style.color = '#ab8b73';
        
        // Reset button after 2 seconds
        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.style.color = '#666';
        }, 2000);
    }).catch(err => {
        console.error('Failed to copy code:', err);
        // Fallback method for older browsers
        copyCodeFallback(code);
    });
}

/**
 * Fallback copy method using textarea
 * @param {string} code - The salon code to copy
 */
function copyCodeFallback(code) {
    const textArea = document.createElement('textarea');
    textArea.value = code;
    textArea.style.position = 'fixed';
    textArea.style.opacity = '0';
    document.body.appendChild(textArea);
    textArea.select();
    
    try {
        document.execCommand('copy');
        // Show success message
        const btn = document.querySelector('.owner-copy-btn');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-check"></i> Copied!';
        btn.style.color = '#ab8b73';
        
        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.style.color = '#666';
        }, 2000);
    } catch (error) {
        // Show code in alert if all else fails
        alert('Salon Code: ' + code);
    }
    
    document.body.removeChild(textArea);
}

/**
 * Navigate back to previous page
 */
function goBack() {
    window.history.back();
}

/**
 * Handle form submission
 * @param {Event} event - Form submit event
 */
function handleContinue(event) {
    event.preventDefault();
    // TODO: Add navigation to registration complete page
    alert('Proceeding to registration complete page...');
}
