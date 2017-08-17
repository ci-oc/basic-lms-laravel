var myCountdownTest = new Countdown({
    time: timer,
    width: 200,
    height: 80,
    onComplete: countdownComplete,
    rangeHi: "minute"
});
function countdownComplete() {
    $("form").submit();
    window.location.href = 'index.php';
}