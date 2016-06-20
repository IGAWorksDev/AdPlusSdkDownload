// Parameter Details
// $usn : 리워드를 지급할 유저 ID
// $reward_key : 리워드 요청에 대한 transaction_id(각 리워드 요청당 unique)
// $quantity : 리워드 지급량
// $campaign_key : 참여 완료한 캠페인 키
// $signed_value : 리워드 요청 보안 체크 값
$hash_key = 'IGAWorks에서_발급한_해시키';

// signed_value 체크 성공
if( $signed_value == hash_hmac('md5', $usn . $reward_key . $quantity . $campaign_key, $hash_key))
{
    // 매체사 서버에서 IGAWorks 의 리워드 지급 요청을 처리하였음에도,
    // 네트워크 오류 등으로 인해 IGAWorks 서버에서 리워드 지급 요청이 실패했다고 판단하고 동일한 지급요청을 다시 보내는 경우가 발생할 수 있음.
    // 이 때 매체사 서버에서는 IGAWorks 서버가 보낸 reward_key 가 이미 지급 처리된 리워드 요청에 대한 reward_key 일 경우 아래와 같이 처리.

    // reward_key 에 해당하는 리워드 지급이 이미 완료 되었는지 체크 
    if( // 이미 리워드 지급이 완료된 reward_key 일 경우 ) {
        // 리워드 중복 지급에 해당하는 Json string return
        // {"Result":false,"ResultCode":3100,"ResultMsg":"duplicate transaction"}
    } else {
        // 유저에게 리워드 지급 후 성공 Json string return 
        // {"Result":true,"ResultCode":1,"ResultMsg":"success"}
    }
} else { //  signed_value 체크 실패 
    //  보안 체크 실패에 해당하는 Json string return 
    // {"Result":false,"ResultCode":1100,"ResultMsg":"invalid hash key"}
}
