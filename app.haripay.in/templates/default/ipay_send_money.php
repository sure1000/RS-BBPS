<form name="ipay_send_money" id="ipay_send_money" method="post" action="dezire_send_money.php" onsubmit="return false;" style="display : none">
    <div class="row">
        <div class="col-md-12 top_margin_10">
            <label><i class="fa fa-address-book-o"></i> Beneficiary</label>
            <select name="beneficiary_id_ipay" id="beneficiary_id_ipay" class="form-control" required  >
            </select>
        </div>
        <div class="col-md-4 top_margin_10">
            <label><i class="fa fa-address-book-o"></i> Transaction Type </label>
            <select name="transactiontype_ipay" id="transactiontype_ipay" class="form-control" required  >
                <option value="IMPS">IMPS</option>
                <option value="NEFT">NEFT</option>

            </select>
        </div>
        <div class="col-md-5 top_margin_10">
            <label><i class="fa fa-mobile"></i>Amount</label>
            <input type="number" step="0.01"name="ipay_send_amount" id="ipay_send_amount" class="form-control" required="required"  placeholder="Amount" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="ipay_send_updte" id="ipay_send_updte" value="1" />
            <button type="submit" name="i_send_submit" id="i_send_submit" class="btn btn-primary form-control btn-large" >Send </button>

        </div>
    </div>
</form>