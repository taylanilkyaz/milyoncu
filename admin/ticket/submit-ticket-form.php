<div  id="submit-ticket-form" class="ui stackable centered grid goodmargin">
    <div class="sixteen wide center aligned column">
            <form class="ui fluid form" method="post" action="submit-ticket.php">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="subject" placeholder="Konu nedir ? ">
                    </div>
                </div>

                <div class="field">
                    <textarea  type="text" name="detail"  placeholder="Sorunuzu yazabilirsiniz."></textarea>
                </div>

                <input id="sendTicket" value="Soru Gönder" name="save" class="huge ui button" type="submit">
                <input value="insertAsParent" style="display: none" name="type" type="text">
            </form>
        </div>
</div>