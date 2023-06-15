<!-- App Header -->
<?php $balance = json_encode(['NGN' => $user->balance, 'BTC'=> $user->BTC, 'ETH'=> $user->ETH, 'USDT'=> $user->USDT]);
$exch = json_encode(['buy_btc' => $settings->btc_buy, 'sell_btc'=> $settings->btc_sell, 'buy_eth' => $settings->eth_buy, 'sell_eth'=> $settings->eth_sell, 'buy_usdt' => $settings->usdt_buy, 'sell_usdt'=> $settings->usdt_sell, 'comission'=>$settings->comission]);
 ?>
<div class="appHeader">
    <div class="left">
        <a href="#" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        <?= $page ?>
    </div>
    <div class="right">
        <a href="#" class="headerButton" onclick="toastbox('toast-1', 2000)">
            <ion-icon name="refresh"></ion-icon>
        </a>
    </div>
</div>
<!-- * App Header -->

<!-- toast top -->
<div id="toast-1" class="toast-box toast-top tap-to-close bg-primary">
    <div class="in">
        <div class="text">
            Exchange rates have been updated!
        </div>
    </div>
</div>
<!-- * toast top -->

<!-- App Capsule -->
<div id="appCapsule">

    <form id="payload">

        <div class="section mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group basic p-0">
                        <div class="exchange-heading">
                            <label class="group-label" for="fromAmount">From <span class="fromm">(<?=$coin ?>)</span></label>
                            <div class="exchange-wallet-info">
                                Balance : <strong class="balance"> 0.00 NGN</strong>
                            </div>
                        </div>
                        <div class="exchange-group">
                            <div class="input-col">
                                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control form-control-lg pe-0 border-0"
                                    id="fromAmount" name="amount" placeholder="0" value="0.00" maxlength="10">
                            </div>
                            <div class="select-col">
                                <select class="form-select form-select-lg currency" id="from" onchange="change()" name="from">
                                    <option value="NGN" selected>NGN</option>
                                    <option value="BTC">BTC</option>
                                    <option value="ETH">ETH</option>
                                    <option value="USDT">USDT</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="section">
            <div class="exchange-line">
                <div class="exchange-icon">
                    <ion-icon name="swap-vertical-outline"></ion-icon>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="card">
                <div class="card-body">
                    <div class="form-group basic p-0">
                        <div class="exchange-heading">
                            <label class="group-label" for="toAmount">To</label>
                            <div class="exchange-wallet-info">
                                Balance : <strong class="toBal"> 0.00</strong>
                            </div>
                        </div>
                        <div class="exchange-group">
                            <div class="input-col">
                                <input type="text" class="form-control form-control-lg pe-0 border-0" id="toAmount"
                                    placeholder="0" value="0.00" disabled>
                            </div>
                            <div class="select-col">
                                <select class="form-select form-select-lg currency" id="sendTo" onchange="sending()" name="to">
                                    <option value="BTC">BTC</option>
                                    <option value="ETH">ETH</option>
                                    <option value="USDT">USDT</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <div class="section mt-2">
            <div class="row fontsize-caption">
                <div class="col">
                    <b>1 <span class="coinType">NGN</span></b> = <span class="theFigure">-:-</span> <span class="changeTo">USD</span>
                </div>
                <div class="col text-end">
                    Commission rate : <b><?=$settings->comission ?>%</b>
                </div>
            </div>
        </div>

        <div class="form-button-group transparent">
            <button type="button" class="btn btn-primary btn-block btn-lg continues"  data-bs-toggle="modal" data-bs-target="#sendActionSheet" disabled>
                Continue
            </button>
        </div>

        <!-- Send Action Sheet -->
        <div class="modal fade action-sheet" id="sendActionSheet" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header migration">
                        <h5 class="modal-title tttle">Complete Swapping</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                          <div class="form-group basic">
                            <div class="input-wrapper">
                              <label class="label" for="">Transaction Pin</label>
                              <div class="input-col">
                                <input type="password" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="4" name="pin" class="form-control form-control-lg pe-0" placeholder="Enter your transaction Pin" value="" required>
                              </div>
                            </div>
                          </div>

                          <div class="mt-2">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Send</button>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * Send Action Sheet-->

    </form>


</div>
<!-- * App Capsule -->

<!-- Success Action Sheet -->
<div id="toast-11" class="toast-box toast-center" style="z-index: 999999999999;">
    <div class="in">
        <ion-icon name="checkmark-circle" class="text-success md hydrated" role="img" aria-label="checkmark circle"></ion-icon>
        <div class="text" id="succ-modal">
            Success Message
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-text-light close-button close">CLOSE</button>
</div>

<!-- Failed Action Sheet -->
<div id="toast-90" class="toast-box toast-center" style="z-index: 99999999999;">
    <div class="in">
        <ion-icon name="close-circle" role="img" class="text-danger md hydrated" aria-label="close circle"></ion-icon>
        <div class="text" id="failed-modal">
            Failed Message
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-text-light close-button">CLOSE</button>
</div>

<div id="toast-16" class="toast-box toast-bottom bg-danger" style="z-index: 999999999999999999;">
    <div class="in">
        <div class="text" id="dang-msg">
            Danger Message
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-text-light close-button">OK</button>
</div>


<style media="screen">
  .appBottomMenu{
    display: none;
  }
</style>

<script>
var from = 'NGN', to = 'BTC';
let balance = <?= $balance ?>;
let exch = <?= $exch ?>;
let settings = exch;

$('.balance').html(parseFloat(balance.NGN).toLocaleString(undefined, {style:"currency", currency:"NGN"}))
let sele = $('#sendTo').find(":selected").val()
from = $('#from').find(":selected").val()

let sel = 'NGN';
$('#from').on('change', function() {
  sel = $(this).find(":selected").val();
  from = sel;

  $('#fromAmount').val('0.00')
  $('#toAmount').val('0.00')
  $('.coinType').html(sel)

  if (sel == 'NGN')
     $('.fromm').html(`(<?=$coin ?>)`)
  else
  $('.fromm').html(`($)`)
})

$('#sendTo').on('change', function() {
  $('#fromAmount').val('0.00')
  $('#toAmount').val('0.00')

  to = $(this).find(":selected").val();
  $('.changeTo').html(to);

  if (to == '' || to == undefined) {
    $('.continues').attr('disabled', true)
  }else {
    $('.continues').attr('disabled', false)
  }

  let select_rate = (sel == 'BTC')? market_rate().BTC.USD : ((sel == 'ETH')? market_rate().ETH.USD : ((sel == 'USDT')? market_rate().USDT.USD : market_rate().NGN.USD));

  let convert_to = (to == 'BTC')? market_rate().BTC.USD : ((to == 'ETH')? market_rate().ETH.USD : ((to == 'USDT')? market_rate().USDT.USD : market_rate().NGN.USD));

  let f_val = parseFloat(select_rate/convert_to).toFixed(9);
  $('.theFigure').html(f_val);

})


//RETURN RECIEVED VALUES ON AMOUNT INPUT/SWAPING
var am = 0;
am = parseFloat($('#fromAmount').val())
if (am == null || am == 0) {
  $('.continues').attr('disabled', true)
}

$('#fromAmount').on('keyup', function () {
  let amount = parseFloat($(this).val())

  if (amount == 0 || amount == null) {
    $('.continues').attr('disabled', true)
  }else {
    $('.continues').attr('disabled', false)
  }

  let currency = (from == 'BTC')? market_rate().BTC.USD : ((from == 'ETH')? market_rate().ETH.USD : ((from == 'USDT')? market_rate().USDT.USD : market_rate().NGN.USD));

  let currency_to = (to == 'BTC')? market_rate().BTC.USD : ((to == 'ETH')? market_rate().ETH.USD : ((to == 'USDT')? market_rate().USDT.USDT : market_rate().NGN.USD));

  let from_ngn = (from == 'NGN' && to == 'BTC') ? settings.sell_btc : ((from == 'NGN' && to == 'ETH') ? settings.sell_eth : ((from == 'NGN' && to == 'USDT') ? settings.sell_usdt : ''))

  let to_ngn = (from == 'BTC' && to == 'NGN') ? settings.buy_btc : ((from == 'ETH' && to == 'NGN') ? settings.buy_eth : ((from == 'USDT' && to == 'NGN') ? settings.buy_usdt : ''))

  let amnt = 0;
  if (from == 'NGN') amount = parseFloat(amount/from_ngn);
  if (to == 'NGN') {
    amnt = parseFloat(amount*to_ngn).toFixed(2)
  }else {
    amnt = parseFloat(amount/currency_to).toFixed(9)
  }

  $('#toAmount').val(amnt);
})



////////////////////////////////////////////////////////////////////////////////
//GET ACCOUNT BALANACE OF THE SENDING TO WALLET
function sending() {
  to = $('#sendTo').val();

  let ngn = parseFloat(balance.NGN).toLocaleString(undefined, {style:"currency", currency:"NGN"});
  let btc_bal = (btc().others.rate * parseFloat(balance.BTC)).toLocaleString(undefined, {style:"currency", currency:"USD"});
  let eth_bal = (eth().others.rate * parseFloat(balance.ETH)).toLocaleString(undefined, {style:"currency", currency:"USD"});
  let usdt_bal = (usdt().others.rate * parseFloat(balance.USDT)).toLocaleString(undefined, {style:"currency", currency:"USD"});

  let current_bal = (to == 'BTC')? btc_bal: ((to == 'ETH')? eth_bal: ((to == 'USDT')? usdt_bal: ngn))

  $('.toBal').html(current_bal)
}

//ON CHANGE, GET RIDE OF THE SENDINT TO OPTIONS
//ALSO GET THE ACCOUNT BALANCE OF THE SENDING FROM WALLET
function change() {
  var from = 'NGN';
  from = $('#from').val();

  let ngn = parseFloat(balance.NGN).toLocaleString(undefined, {style:"currency", currency:"NGN"});
  let btc_bal = (btc().others.rate * parseFloat(balance.BTC)).toLocaleString(undefined, {style:"currency", currency:"USD"});
  let eth_bal = (eth().others.rate * parseFloat(balance.ETH)).toLocaleString(undefined, {style:"currency", currency:"USD"});
  let usdt_bal = (usdt().others.rate * parseFloat(balance.USDT)).toLocaleString(undefined, {style:"currency", currency:"USD"});

  let current_bal = (from == 'BTC')? btc_bal: ((from == 'ETH')? eth_bal: ((from == 'USDT')? usdt_bal: ngn))

  $('.balance').html(current_bal)

  let option = ['NGN', 'BTC', 'ETH', 'USDT'].filter(value => value !== from );
  newOption = '<option value="">--:--</option>';
  $('#sendTo').html('')
  option.forEach(value => newOption += `<option value="${value}">${value}</option>`)
  $('#sendTo').append(newOption)
}

$('.close').click(function () {
  window.location.href= 'crypto-index'
})

$('#payload').submit(function(e) {
  e.preventDefault();

  var formData = new FormData($(this)[0]);
  $thiss = $(this).find("[type=submit]");
  $thiss.text("please wait...");
  $thiss.addClass("disabled");

  $.ajax({
      url: '<?=$siteurl?>trans/swap-crypto',
      type: 'POST',
      data: formData,
      dataType: "json",
      cache: false,
      contentType: false,
      processData: false,
      success : function(data){
        data = JSON.parse(data);
          // console.log(data);
          if (data.status == true){
            $("#succ-modal").html(data.message);
            // $("#succ").click();
            toastbox('toast-11');
            $thiss.text("Deposit");
            $thiss.removeClass("disabled");
            $('#payload')[0].reset()
          } else {
              $thiss.text("Deposit");
              $thiss.removeClass("disabled");
              $("#failed-modal").html(data.message);
              toastbox('toast-90');
              // $("#dang").click();
          }
      }
  }).fail(function (jqXHR, textStatus, error) {
      // Handle error here
      console.log(jqXHR, textStatus, error);
      $thiss.text("Deposit");
      $thiss.removeClass("disabled");
      $("#failed-modal").html(jqXHR.responseText);
      toastbox('toast-90');
      // console.log(jqXHR.responseText);
  });
})

</script>
