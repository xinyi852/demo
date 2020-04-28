function checkInvoice(invoiceNumber){
    $.post('/client/credit/payment/checkinvoicestatus',{invoiceNumber: invoiceNumber}, function(resp){
        if(resp.status === 'error'){
            // 查询出错 sweetalter
            swal("抱歉!", "账单不存在, 请尝试重新进行充值!", "error");
        }else{
            if(resp.invoiceStatus === 'paid')
            {
                // 已经完成支付了
                swal({
                    title:"恭喜您!",
                    text:"余额充值成功, 系统已经为您自动入账对应金额!",
                    icon:"success"
                });
                // 跳转到余额查询页面
                window.location = '/client/credit/addfunds';
            }
        }
    })
}

function checkDNSCNAME(fullname, fullvalue, thisobj)
{
    var that = thisobj;
    $(thisobj).attr('disabled','disabled');
    var md5hash = $(thisobj).data('domainhash');
    var successElem = $('div.alert-success[data-domainhash='+md5hash+']');
    var warningElem = $('div.alert-warning[data-domainhash='+md5hash+']');
    var errorElem = $('div.alert-danger[data-domainhash='+md5hash+']');
    $(successElem).hide();
    $(errorElem).hide();
    $(warningElem).show();
    $.post("/client/digitalcert/checkdns", {fullname:fullname, fullvalue:fullvalue}, function(resp){
        if(resp.status === "success"){
            $(successElem).children('span.message').html(resp.message);
            $(successElem).show();
            $(errorElem).hide();
        }else{
            $(errorElem).children('span.message').html(resp.message);
            $(errorElem).show();
            $(successElem).hide();
        }
        $(warningElem).hide();
        $(thisobj).removeAttr('disabled');
    });
}
function cancelandrefund(thisobj, serviceid)
{
    var that = thisobj;
    $(thisobj).attr('disabled','disabled');
    $(thisobj).html("执行中...");
    $.post('/client/digitalcert/cancelAndRefund', {serviceid: serviceid}, function(resp){
        if(resp.status === "success"){
            window.location.reload();
        }else{
            swal({
                title: "Sorry!",
                text: resp.message,
                icon: "error",
                button: "好的"
            });
        }
        $(thisobj).html("取消并退款");
        $(thisobj).removeAttr('disabled');
    })
}

function assignCustomer(thisobj, serviceid)
{
    var that = thisobj;
    var text = $(that).html();
    $(thisobj).attr('disabled','disabled');
    $(thisobj).html("执行中...");
    $.post('/client/digitalcert/updatemeta', {action:'assignCustomer',serviceid: serviceid, customerid:$('select[name=mycustomer]').val()}, function(resp){
        if(resp.status === "success"){
            $('span[data-api-mycustomername]').text($('select[name=mycustomer] option:selected').text());
            $('#customerModal1').modal('hide');
        }else{
            swal({
                title: "Sorry!",
                text: resp.message,
                icon: "error",
                button: "好的"
            });
        }
        $(thisobj).html(text);
        $(thisobj).removeAttr('disabled');
    })
}

function setNotes(thisobj, serviceid)
{
    var that = thisobj;
    var text = $(that).html();
    $(thisobj).attr('disabled','disabled');
    $(thisobj).html("执行中...");
    $.post('/client/digitalcert/updatemeta', {action:'updateNotes',serviceid: serviceid, notes:$('textarea[data-api-notes]').val()}, function(resp){
        if(resp.status === "success"){
            $('span[data-api-notes]').text($('textarea[data-api-notes]').val());
            $('#notesModal1').modal('hide');
        }else{
            swal({
                title: "Sorry!",
                text: resp.message,
                icon: "error",
                button: "好的"
            });
        }
        $(thisobj).html(text);
        $(thisobj).removeAttr('disabled');
    })
}

function setPrice(thisobj, serviceid)
{
    var that = thisobj;
    var text = $(that).html();
    $(thisobj).attr('disabled','disabled');
    $(thisobj).html("执行中...");
    $.post('/client/digitalcert/updatemeta', {action:'updatePrice',serviceid: serviceid, price:$('input[data-api-price]').val()}, function(resp){
        if(resp.status === "success"){
            $('span[data-api-price]').text($('input[data-api-price]').val());
            $('#priceModal1').modal('hide');
        }else{
            swal({
                title: "Sorry!",
                text: resp.message,
                icon: "error",
                button: "好的"
            });
        }
        $(thisobj).html(text);
        $(thisobj).removeAttr('disabled');
    })
}

function revokeSSL(thisobj, serviceid)
{
    var that = thisobj;
    $(thisobj).attr('disabled','disabled');
    $(thisobj).html("执行中...");
    $.post('/client/digitalcert/revokeSSL', {serviceid: serviceid, revokeReason:$('input[name=revokeReason]').val()}, function(resp){
        if(resp.status === "success"){
            window.location.reload();
        }else{
            swal({
                title: "Sorry!",
                text: resp.message,
                icon: "error",
                button: "好的"
            });
        }
        $(thisobj).html("确认吊销");
        $(thisobj).removeAttr('disabled');
    })
}
function trytoReplaceCsrCode(thisobj)
{
    var that = thisobj;
    $(thisobj).attr('disabled','disabled');
    $(thisobj).html("执行中...");
    $.post('/client/digitalcert/replaceCsrCode', $('#formCsrReplacement').serialize(), function(resp){
        if(resp.status === "success"){
            window.location.reload();
        }else{
            swal({
                title: "Sorry!",
                text: resp.message,
                icon: "error",
                button: "好的"
            });
        }
        $(thisobj).html("保存");
        $(thisobj).removeAttr('disabled');
    })
}
function syncDeleteDomain(domainName, serviceid, thisobj)
{
    var that = thisobj;
    $(thisobj).attr('disabled','disabled');
    $(thisobj).html("执行中...");
    var md5hash = $(thisobj).data('domainhash');
    $.post('/client/digitalcert/removeSanDomain', {serviceid:serviceid,domainName: domainName}, function(resp){
        if(resp.status === "success"){
            $('tr[data-domainhash='+md5hash+']').remove();
        }else{
            swal({
                title: "Sorry!",
                text: resp.message,
                icon: "error",
                button: "好的"
            });
        }
        $(thisobj).html("删除");
        $(thisobj).removeAttr('disabled');
    })
}
function tryToAddDomains(serviceid, thisobj){
    var that = thisobj;
    $(thisobj).attr('disabled','disabled');
    $(thisobj).html("执行中...");
    $.post('/client/digitalcert/changeDomains', {action:'addDomainNames',serviceid:serviceid,domains:$('textarea[name=domains]').val()}, function(resp){
        if(resp.error === undefined){
            window.location.reload();
        }else{
            swal({
                title: "Sorry!",
                text: resp.error,
                icon: "error",
                button: "好的"
            });
        }
        $(thisobj).html("保存域名");
        $(thisobj).removeAttr('disabled');
    })
}
function tryToDelDomains(serviceid,domainName, thisobj){
    var that = thisobj;
    $(thisobj).attr('disabled','disabled');
    var md5hash = $(thisobj).data('domainhash');
    $(thisobj).html("执行中...");
    $.post('/client/digitalcert/changeDomains', {action:'delDomainNames',serviceid:serviceid,domain:domainName}, function(resp){
        if(resp.error === undefined){
            $('tr[data-domainhash='+md5hash+']').remove();
        }else{
            swal({
                title: "Sorry!",
                text: resp.error,
                icon: "error",
                button: "好的"
            });
        }
        $(thisobj).html("删除");
        $(thisobj).removeAttr('disabled');
    })
}
function tryToSubmitCA(serviceid, thisobj){
    var that = thisobj;
    $(thisobj).attr('disabled','disabled');
    var md5hash = $(thisobj).data('domainhash');
    $(thisobj).html("执行中...");
    $.post('/client/digitalcert/submitca', {serviceid:serviceid}, function(resp){
        if(resp.status === "success"){
            window.location.reload();
        }else{
            swal({
                title: "Sorry!",
                text: resp.message,
                icon: "error",
                button: "好的"
            });
        }
        $(thisobj).html("确认提交");
        $(thisobj).removeAttr('disabled');
    })
}
function tryToReissue(serviceid, thisobj){
    var that = thisobj;
    $(thisobj).attr('disabled','disabled');
    var md5hash = $(thisobj).data('domainhash');
    $(thisobj).html("执行中...");
    $.post('/client/digitalcert/changeDomains', {action:'reissue',serviceid:serviceid}, function(resp){
        if(resp.error === undefined){
            window.location.reload();
        }else{
            swal({
                title: "Sorry!",
                text: resp.error,
                icon: "error",
                button: "好的"
            });
        }
        $(thisobj).html("立即重签证书");
        $(thisobj).removeAttr('disabled');
    })
}
function fetchCertificate(serviceid, thisobj)
{
    var that = thisobj;
    $(thisobj).attr('disabled','disabled');
    $(thisobj).html("执行中...");
    $.post('/client/digitalcert/fetch', {serviceid:serviceid}, function(resp){
        if(resp.status === "success"){
            window.location.reload();
        }else{
            swal({
                title: "Sorry!",
                text: resp.message,
                icon: "error",
                button: "好的"
            });
        }
        $(thisobj).html("同步证书状态");
        $(thisobj).removeAttr('disabled');
    })
}
function redoDomainVerification(serviceid, thisobj)
{
    var that = thisobj;
    $(thisobj).attr('disabled','disabled');
    $(thisobj).html("执行中...");
    $.post('/client/digitalcert/redodomainverification', {serviceid:serviceid}, function(resp){
        if(resp.status === "success"){
            swal({
                title: "Good job!",
                text: resp.message,
                icon: "success",
                button: "好的"
            });
        }else{
            swal({
                title: "Sorry!",
                text: resp.message,
                icon: "error",
                button: "好的"
            });
        }
        $(thisobj).html("重执验证");
        $(thisobj).removeAttr('disabled');
    })
}

var clipboard = new ClipboardJS('button[data-clipbutton]');
clipboard.on('success', function(e) {
    $(e.trigger).text('复制成功');
    e.clearSelection();
});

clipboard.on('error', function(e) {
    $(e.trigger).text('复制失败');
});
function getFormatTime(nS) {
    var date=new Date(nS);
    var year=date.getFullYear();
    var mon = date.getMonth()+1;
    var day = date.getDate();
    var hours = date.getHours();
    var minu = date.getMinutes();
    var sec = date.getSeconds();
    return year+'-'+mon+'-'+day+' '+hours+':'+minu+':'+sec;
}
function dcvDownloadFile(content, filename){
    var a = document.createElement("a");
    document.body.appendChild(a);
    a.style = "display: none";
    var json = content,
        blob = new Blob([json], {type: "octet/stream"}),
        url = window.URL.createObjectURL(blob);
    a.href = url;
    a.download = filename;
    a.click();
    window.URL.revokeObjectURL(url);
}