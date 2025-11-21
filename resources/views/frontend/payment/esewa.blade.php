Please Wait. Redirecting to Payment Page....

@php
    $AMT = getTotalAmount();
    $TXAMT = 0;
    $PSC = 0;
    $PDC = 0;
    $TAMT = $AMT + $TXAMT + $PSC + $PDC;
    $SCD = 'EPAYTEST';
    $SU = URL::to('/') . '/esewasuccess?q=su';
    $FU = URL::to('/') . '/esewafailure?q=fu';
    $devurl = 'https://uat.esewa.com.np/epay/main';
    $liveurl = 'https://esewa.com.np/epay/main';
@endphp

<body>
    <form action="{{ $devurl }}" method="POST" id="esewapaymentForm">
        <input value="{{ $TAMT }}" name="tAmt" type="hidden">
        <input value="{{ $AMT }}" name="amt" type="hidden">
        <input value="{{ $TXAMT }}" name="txAmt" type="hidden">
        <input value="{{ $PSC }}" name="psc" type="hidden">
        <input value="{{ $PDC }}" name="pdc" type="hidden">
        <input value="{{ $SCD }}" name="scd" type="hidden">
        <input value="{{ $order_number }}" name="pid" type="hidden">
        <input value="{{ $SU }}" type="hidden" name="su">
        <input value="{{ $FU }}" type="hidden" name="fu">
    </form>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        document.getElementById('esewapaymentForm').submit();
    });
</script>
