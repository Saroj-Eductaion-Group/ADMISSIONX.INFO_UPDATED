<hr>
<div class="col-md-12">
    <div class="white-bg padding-top10 padding-bottom10 padding-left10 padding-right10">
        <div id="collapseOne{{$item->id}}" class="panel-collapse collapse" aria-expanded="flase" style="">
            <div class="panel-body">
                <div class="row">
                    <ul class="list-inline tags-v3">
                        <li><a class="btn-block btn btn-sm btn-success" title="EXAMINATION DETAILS" href="{{ url('/get-examination-details-partial/' . $item->id) }}" target="_blank"><i class="fa fa-edit"></i> EXAMINATION DETAILS</a></li>
                        <li><a class="btn-block btn btn-sm btn-success" title="APPLICATION PROCESSES" href="{{ url('/get-application-processes-partial/' . $item->id) }}" target="_blank"><i class="fa fa-edit"></i> APPLICATION PROCESSES</a></li>
                        <li><a class="btn-block btn btn-sm btn-success" title="EXAM ELIGIBILITIES" href="{{ url('/get-exam-eligibilities-partial/' . $item->id) }}" target="_blank"><i class="fa fa-edit"></i> EXAM ELIGIBILITIES</a></li>
                        <li><a class="btn-block btn btn-sm btn-success" title="EXAM DATES" href="{{ url('/get-exam-dates-partial/' . $item->id) }}" target="_blank"><i class="fa fa-edit"></i> EXAM DATES</a></li>
                        <li><a class="btn-block btn btn-sm btn-success" title="EXAM SYLLABUS PAPERS" href="{{ url('/get-exam-syllabus-papers-partial/' . $item->id) }}" target="_blank"><i class="fa fa-edit"></i> EXAM SYLLABUS PAPERS</a></li>
                        <li><a class="btn-block btn btn-sm btn-success" title="EXAM PATTERNS" href="{{ url('/get-exam-patterns-partial/' . $item->id) }}" target="_blank"><i class="fa fa-edit"></i> EXAM PATTERNS</a></li>
                        <li><a class="btn-block btn btn-sm btn-success" title="EXAM ADMIT CARDS" href="{{ url('/get-exam-admit-cards-partial/' . $item->id) }}" target="_blank"><i class="fa fa-edit"></i> EXAM ADMIT CARDS</a></li>
                        <li><a class="btn-block btn btn-sm btn-success" title="EXAM RESULTS" href="{{ url('/get-exam-results-partial/' . $item->id) }}" target="_blank"><i class="fa fa-edit"></i> EXAM RESULTS</a></li>
                        <li><a class="btn-block btn btn-sm btn-success" title="EXAM CUT OFFS" href="{{ url('/get-exam-cut-offs-partial/' . $item->id) }}" target="_blank"><i class="fa fa-edit"></i> EXAM CUT OFFS</a></li>
                        <li><a class="btn-block btn btn-sm btn-success" title="EXAM COUNSELLINGS" href="{{ url('/get-exam-counsellings-partial/' . $item->id) }}" target="_blank"><i class="fa fa-edit"></i> EXAM COUNSELLINGS</a></li>
                        <li><a class="btn-block btn btn-sm btn-success" title="EXAM PREPRATION TIPS" href="{{ url('/get-exam-prepration-tips-partial/' . $item->id) }}" target="_blank"><i class="fa fa-edit"></i> EXAM PREPRATION TIPS</a></li>
                        <li><a class="btn-block btn btn-sm btn-success" title="EXAM ANSWER KEY" href="{{ url('/get-exam-answer-key-partial/' . $item->id) }}" target="_blank"><i class="fa fa-edit"></i> EXAM ANSWER KEY</a></li>
                        <li><a class="btn-block btn btn-sm btn-success" title="EXAM ANALYSIS RECORDS" href="{{ url('/get-exam-analysis-records-partial/' . $item->id) }}" target="_blank"><i class="fa fa-edit"></i> EXAM ANALYSIS RECORDS</a></li>
                        <li><a class="btn-block btn btn-sm btn-success" title="EXAMINATION REFERENCE LINKS" href="{{ url('/get-examination-reference-links-partial/' . $item->id) }}" target="_blank"><i class="fa fa-edit"></i> EXAMINATION REFERENCE LINKS</a></li>
                        <li><a class="btn-block btn btn-sm btn-success" title="EXAM FAQS" href="{{ url('/get-exam-faqs-partial/' . $item->id) }}" target="_blank"><i class="fa fa-edit"></i> EXAM FAQS</a></li>
                        <li><a class="btn-block btn btn-sm btn-success" title="ASK EXAM QUESTIONS & ANSWER" href="{{ url('/get-ask-exam-questions-partial/' . $item->id) }}" target="_blank"><i class="fa fa-edit"></i> ASK EXAM QUESTIONS & ANSWER</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>