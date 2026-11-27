<?php

//検索パラメータを取得する
$company_area    = get_query_var( 'company_area' );
$company_tsubo   = get_query_var( 'company_tsubo' );
$company_kodawari = get_query_var( 'company_kodawari' );
$company_keyword = get_query_var( 'company_keyword' );

/*

<div class="modBlockSearch">
    <div class="container">

        <form action="/company/" method="post">
            <dl class="body">
                <dt>岡山・倉敷の<span>工務店を探す</span></dt>
                <dd>
                    <div class="form selct">
                        <?php the_form_select('company_area','施工予定エリア',$company_area); ?>
                    </div>
                    <div class="form selct">
                        <?php the_form_select('company_tsubo','坪単価',$company_tsubo); ?>
                    </div>
                    <div class="form selct">
                        <?php the_form_select('company_kodawari','こだわり',$company_kodawari); ?>
                    </div>
                    <div class="form free">
                        <input type="text" name="company_keyword" placeholder="フリーワード（社名など）" value="<?php echo $company_keyword; ?>">
                    </div>
                    <div class="btn">
                        <button type="search" class="search">検索</button>
                    </div>
                </dd>
            </dl>
        </form>
    </div>
</div><!-- /.modBlockSearch -->
*/
?>