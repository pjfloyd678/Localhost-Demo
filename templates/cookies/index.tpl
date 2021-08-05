        {if $action === "save"}
                <form id="updateuser">
                    {if !empty($smarty.session.user_id)}<input type="hidden" name="user_id" id="user_id" value="{$smarty.session.user_id}" />{/if}
                    <p><input type="radio" id="tracking_yes" value="1" name="tracking"> Accept All</p>
                    <p><input type="radio" value="0" id="tracking_no" name="tracking"> No Thanks</p>
                    <p id="update_post">
                        <button type="submit" id="update_post_submit">Save Preferences</button>
                    </p>
                </form>
        {/if}


