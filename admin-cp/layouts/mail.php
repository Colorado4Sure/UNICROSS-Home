<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-ibx">
                    <div class="nk-ibx-aside" data-content="inbox-aside" data-toggle-overlay="true" data-toggle-screen="lg">
                        <div class="nk-ibx-head">
                            <h5 class="mb-0"><?= $page ?></h5>
                            <a href="#" class="link link-primary" data-toggle="modal" data-target="#compose-mail"><em class="icon ni ni-plus"></em> <span>Compose</span></a>
                        </div>
                        <div class="nk-ibx-nav" data-simplebar>
                            <ul class="nk-ibx-menu">
                                <li class="active">
                                    <a class="nk-ibx-menu-item" href="#">
                                        <em class="icon ni ni-inbox"></em>
                                        <span class="nk-ibx-menu-text">Inbox</span>
                                        <span class="badge badge-pill badge-primary">8</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="nk-ibx-menu-item" href="#">
                                        <em class="icon ni ni-edit"></em>
                                        <span class="nk-ibx-menu-text">Draft</span>
                                        <span class="badge badge-pill badge-light">12</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="nk-ibx-menu-item" href="#">
                                        <em class="icon ni ni-send"></em>
                                        <span class="nk-ibx-menu-text">Sent</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- .nk-ibx-aside -->
                    <div class="nk-ibx-body bg-white">
                        <div class="nk-ibx-head">
                            <!-- <div class="nk-ibx-head-actions">
                                <div class="nk-ibx-head-check">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input nk-dt-item-check" id="conversionAll">
                                        <label class="custom-control-label" for="conversionAll"></label>
                                    </div>
                                </div>
                                <ul class="nk-ibx-head-tools g-1">
                                    <li><a href="#" class="btn btn-icon btn-trigger"><em class="icon ni ni-undo"></em></a></li>
                                    <li class="d-none d-sm-block"><a href="#" class="btn btn-icon btn-trigger"><em class="icon ni ni-archived"></em></a></li>
                                    <li class="d-none d-sm-block"><a href="#" class="btn btn-icon btn-trigger"><em class="icon ni ni-trash"></em></a></li>
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-v"></em></a>
                                            <div class="dropdown-menu">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a class="dropdown-item" href="#"><em class="icon ni ni-eye"></em><span>Move to</span></a></li>
                                                    <li><a class="dropdown-item" href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                    <li><a class="dropdown-item" href="#"><em class="icon ni ni-archived"></em><span>Archive</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div> -->
                            <div>
                                <ul class="nk-ibx-head-tools g-1">
                                    <li class="mr-n1 d-lg-none"><h5 class="mb-0"><?= $page ?></h5></li>
                                    <li class="mr-n1 d-lg-none"></li>

                                    <li class="mr-n1 d-lg-none"><a href="#" class="btn btn-trigger btn-icon btn-tooltip" title="Inbox"><em class="icon ni ni-inbox"></em></a></li>

                                    <li class="mr-n1 d-lg-none"><a href="#" class="btn btn-trigger btn-icon btn-tooltip" title="Drafts"><em class="icon ni ni-file"></em></a></li>

                                    <li class="mr-n1 d-lg-none"><a href="#" class="btn btn-trigger btn-icon btn-tooltip" title="Sent mails"><em class="icon ni ni-send"></em></a></li>
                                </ul>
                            </div>

                            <div class="nk-ibx-head-actions">
                                    <ul class="nk-ibx-head-tools g-1">
                                    <li class="mr-n1 d-lg-none"><a href="#" class="link link-primary" data-toggle="modal" data-target="#compose-mail"><em class="icon ni ni-plus"></em><span>Compose</span></a></li>
                                    </ul>
                                </div>

                        </div><!-- .nk-ibx-head -->
                        <div class="nk-ibx-list" data-simplebar>
                            <?php for ($i=0; $i < 15; $i++): ?>
                            <div class="nk-ibx-item is-unread">
                                <a href="#" class="nk-ibx-link"></a>
                                <div class="nk-ibx-item-elem nk-ibx-item-check">
                                    <div class="custom-control custom-control-sm custom-checkbox">
                                        <input type="checkbox" class="custom-control-input nk-dt-item-check" id="conversionItem01">
                                        <label class="custom-control-label" for="conversionItem01"></label>
                                    </div>
                                </div>
                                <div class="nk-ibx-item-elem nk-ibx-item-user">
                                    <div class="user-card">
                                        <div class="user-avatar bg-indigo">
                                            <span>LH</span>
                                        </div>
                                        <div class="user-name">
                                            <div class="lead-text">Larry Hughes</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-ibx-item-elem nk-ibx-item-fluid">
                                    <div class="nk-ibx-context-group">
                                        <div class="nk-ibx-context">
                                            <span class="nk-ibx-context-text">
                                                <span class="heading">Can we help you set up email forwording?</span> We’ve noticed you haven’t set up email forward </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-ibx-item-elem nk-ibx-item-attach">
                                </div>
                                <div class="nk-ibx-item-elem nk-ibx-item-time">
                                    <div class="sub-text">10:00 AM</div>
                                </div>
                                <div class="nk-ibx-item-elem nk-ibx-item-tools">
                                    <div class="ibx-actions">
                                        <ul class="ibx-actions-visible gx-2">
                                            <li>
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a class="dropdown-item" href="#"><em class="icon ni ni-eye"></em><span>View</span></a></li>
                                                            <li><a class="dropdown-item" href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-ibx-item -->
                            <?php endfor; ?>
                        </div><!-- .nk-ibx-list -->
                        <div class="nk-ibx-view">
                            <div class="nk-ibx-head">
                                <div class="nk-ibx-head-actions">
                                    <ul class="nk-ibx-head-tools g-1">
                                        <li class="ml-n2"><a href="#" class="btn btn-icon btn-trigger nk-ibx-hide"><em class="icon ni ni-arrow-left"></em></a></li>
                                        
                                        <li><a href="#" class="btn btn-icon btn-trigger btn-tooltip" title="Delete"><em class="icon ni ni-trash"></em></a></li>
                                    </ul>
                                </div>
                                <div class="search-wrap" data-search="search">
                                    <div class="search-content">
                                        <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                        <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or message">
                                        <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                    </div>
                                </div><!-- .search-wrap -->
                            </div><!-- .nk-ibx-head -->
                            <div class="nk-ibx-reply nk-reply" data-simplebar>
                                <div class="nk-ibx-reply-head">
                                    <div>
                                        <h4 class="title">Introducing New Dashboard</h4>
                                        <ul class="nk-ibx-tags g-1">
                                            <li class="btn-group is-tags">
                                                <a class="btn btn-xs btn-primary btn-dim" href="#">Business</a>
                                                <a class="btn btn-xs btn-icon btn-primary btn-dim" href="#"><em class="icon ni ni-cross"></em></a>
                                            </li>
                                            <li class="btn-group is-tags">
                                                <a class="btn btn-xs btn-danger btn-dim" href="#">Management</a>
                                                <a class="btn btn-xs btn-icon btn-danger btn-dim" href="#"><em class="icon ni ni-cross"></em></a>
                                            </li>
                                            <li class="btn-group is-tags">
                                                <a class="btn btn-xs btn-info btn-dim" href="#">Team</a>
                                                <a class="btn btn-xs btn-icon btn-info btn-dim" href="#"><em class="icon ni ni-cross"></em></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <ul class="d-flex g-1">
                                        <li class="d-none d-sm-block">
                                            <a href="#" class="btn btn-icon btn-trigger btn-tooltip" title="Print"><em class="icon ni ni-printer"></em></a>
                                        </li>
                                        <li class="mr-n1">
                                            <div class="asterisk"><a class="btn btn-trigger btn-icon btn-tooltip" href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="nk-ibx-reply-group">
                                    <div class="nk-ibx-reply-item nk-reply-item">
                                        <div class="nk-reply-header nk-ibx-reply-header is-collapsed">
                                            <div class="nk-reply-desc">
                                                <div class="nk-reply-avatar user-avatar bg-blue">
                                                    <span>AB</span>
                                                </div>
                                                <div class="nk-reply-info">
                                                    <div class="nk-reply-author lead-text">Abu Bin Ishtiyak <span class="date d-sm-none">14 Jan, 2020</span></div>
                                                    <div class="dropdown nk-reply-msg-info">
                                                        <a href="#" class="dropdown-toggle sub-text dropdown-indicator" data-toggle="dropdown">to Mildred</a>
                                                        <div class="dropdown-menu dropdown-menu-md">
                                                            <ul class="nk-reply-msg-meta">
                                                                <li><span class="label">from:</span> <span class="info"><a href="#">info@softnio.com</a></span></li>
                                                                <li><span class="label">to:</span> <span class="info"><a href="#">team@softnio.com</a></span></li>
                                                                <li><span class="label">bcc:</span> <span class="info"><a href="#">team@softnio.com</a></span></li>
                                                                <li><span class="label">mailed-by:</span> <span class="info"><a href="#">softnio.com</a></span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="nk-reply-msg-excerpt">I am facing problem as i can not select currency on buy order page. Can you guys let me know what i am doing doing wrong? Please check attached files.</div>
                                                </div>
                                            </div>
                                            <ul class="nk-reply-tools g-1">
                                                <li class="attach-msg"><em class="icon ni ni-clip-h"></em></li>
                                                <li class="date-msg"><span class="date">14 Jan, 2020</span></li>
                                                <li class="replyto-msg"><a href="#" class="btn btn-trigger btn-icon btn-tooltip" title="Reply"><em class="icon ni ni-curve-up-left"></em></a></li>
                                                <li class="more-actions">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-trigger btn-icon" data-toggle="dropdown"><em class="icon ni ni-more-v"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a class="dropdown-item" href="#"><em class="icon ni ni-reply-fill"></em><span>Reply to</span></a></li>
                                                                <li><a class="dropdown-item" href="#"><em class="icon ni ni-forward-arrow-fill"></em><span>Forward</span></a></li>
                                                                <li><a class="dropdown-item" href="#"><em class="icon ni ni-trash-fill"></em><span>Delete this</span></a></li>
                                                                <li><a class="dropdown-item" href="#"><em class="icon ni ni-report-fill"></em><span>Report Spam</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="nk-reply-body nk-ibx-reply-body">
                                            <div class="nk-reply-entry entry">
                                                <p>Hello team,</p>
                                                <p>I am facing problem as i can not select currency on buy order page. Can you guys let me know what i am doing doing wrong? Please check attached files.</p>
                                                <p>Thank you <br> Ishityak</p>
                                            </div>
                                            <div class="attach-files">
                                                <ul class="attach-list">
                                                    <li class="attach-item">
                                                        <a class="download" href="#"><em class="icon ni ni-img"></em><span>error-show-On-order.jpg</span></a>
                                                    </li>
                                                    <li class="attach-item">
                                                        <a class="download" href="#"><em class="icon ni ni-img"></em><span>full-page-error.jpg</span></a>
                                                    </li>
                                                </ul>
                                                <div class="attach-foot">
                                                    <span class="attach-info">2 files attached</span>
                                                    <a class="attach-download link" href="#"><em class="icon ni ni-download"></em><span>Download All</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .nk-reply-item -->
                                    <div class="nk-ibx-reply-item nk-reply-item">
                                        <div class="nk-reply-header nk-ibx-reply-header">
                                            <div class="nk-reply-desc">
                                                <div class="nk-reply-avatar user-avatar bg-blue">
                                                    <img src="./images/avatar/c-sm.jpg" alt="">
                                                </div>
                                                <div class="nk-reply-info">
                                                    <div class="nk-reply-author lead-text">Mildred Delgado <span class="date d-sm-none">18 Jan, 2020</span></div>
                                                    <div class="dropdown nk-reply-msg-info">
                                                        <a href="#" class="dropdown-toggle sub-text dropdown-indicator" data-toggle="dropdown">to Me</a>
                                                        <div class="dropdown-menu dropdown-menu-md">
                                                            <ul class="nk-reply-msg-meta">
                                                                <li><span class="label">from:</span> <span class="info"><a href="#">info@softnio.com</a></span></li>
                                                                <li><span class="label">to:</span> <span class="info"><a href="#">team@softnio.com</a></span></li>
                                                                <li><span class="label">bcc:</span> <span class="info"><a href="#">team@softnio.com</a></span></li>
                                                                <li><span class="label">mailed-by:</span> <span class="info"><a href="#">softnio.com</a></span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="nk-reply-msg-excerpt">It would be great if you send me itiam ut neque in magna porttitor...</div>
                                                </div>
                                            </div>
                                            <ul class="nk-reply-tools g-1">
                                                <li class="date-msg"><span class="date">14 Jan, 2020</span></li>
                                                <li class="replyto-msg"><a href="#" class="btn btn-trigger btn-icon btn-tooltip" title="Reply"><em class="icon ni ni-curve-up-left"></em></a></li>
                                                <li class="more-actions">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-trigger btn-icon" data-toggle="dropdown"><em class="icon ni ni-more-v"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a class="dropdown-item" href="#"><em class="icon ni ni-reply-fill"></em><span>Reply to</span></a></li>
                                                                <li><a class="dropdown-item" href="#"><em class="icon ni ni-forward-arrow-fill"></em><span>Forward</span></a></li>
                                                                <li><a class="dropdown-item" href="#"><em class="icon ni ni-trash-fill"></em><span>Delete this</span></a></li>
                                                                <li><a class="dropdown-item" href="#"><em class="icon ni ni-report-fill"></em><span>Report Spam</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="nk-reply-body nk-ibx-reply-body">
                                            <div class="nk-reply-entry entry">
                                                <p>Hello team,</p>
                                                <p>I am facing problem as i can not select currency on buy order page. Can you guys let me know what i am doing doing wrong? Please check attached files.</p>
                                                <p>Thank you <br> Ishityak</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .nk-reply-item -->
                                    <div class="nk-ibx-reply-item nk-reply-item">
                                        <div class="nk-reply-header nk-ibx-reply-header is-opened">
                                            <div class="nk-reply-desc">
                                                <div class="nk-reply-avatar user-avatar bg-blue">
                                                    <span>AB</span>
                                                </div>
                                                <div class="nk-reply-info">
                                                    <div class="nk-reply-author lead-text">Abu Bin Ishtiyak <span class="date d-sm-none">20 Jan, 2020</span></div>
                                                    <div class="dropdown nk-reply-msg-info">
                                                        <a href="#" class="dropdown-toggle sub-text dropdown-indicator" data-toggle="dropdown">to Mildred</a>
                                                        <div class="dropdown-menu dropdown-menu-md">
                                                            <ul class="nk-reply-msg-meta">
                                                                <li><span class="label">from:</span> <span class="info"><a href="#">info@softnio.com</a></span></li>
                                                                <li><span class="label">to:</span> <span class="info"><a href="#">team@softnio.com</a></span></li>
                                                                <li><span class="label">bcc:</span> <span class="info"><a href="#">team@softnio.com</a></span></li>
                                                                <li><span class="label">mailed-by:</span> <span class="info"><a href="#">softnio.com</a></span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="nk-reply-msg-excerpt">It would be great if you send me itiam ut neque in magna porttitor...</div>
                                                </div>
                                            </div>
                                            <ul class="nk-reply-tools g-1">
                                                <li class="date-msg"><span class="date">14 Jan, 2020</span></li>
                                                <li class="replyto-msg"><a href="#" class="btn btn-trigger btn-icon btn-tooltip" title="Reply"><em class="icon ni ni-curve-up-left"></em></a></li>
                                                <li class="more-actions">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-trigger btn-icon" data-toggle="dropdown"><em class="icon ni ni-more-v"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a class="dropdown-item" href="#"><em class="icon ni ni-reply-fill"></em><span>Reply to</span></a></li>
                                                                <li><a class="dropdown-item" href="#"><em class="icon ni ni-forward-arrow-fill"></em><span>Forward</span></a></li>
                                                                <li><a class="dropdown-item" href="#"><em class="icon ni ni-trash-fill"></em><span>Delete this</span></a></li>
                                                                <li><a class="dropdown-item" href="#"><em class="icon ni ni-report-fill"></em><span>Report Spam</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="nk-reply-body nk-ibx-reply-body">
                                            <div class="nk-reply-entry entry">
                                                <p>Hello team,</p>
                                                <p>I am facing problem as i can not select currency on buy order page. Can you guys let me know what i am doing doing wrong? Please check attached files.</p>
                                                <p>Thank you <br> Ishityak</p>
                                            </div>
                                        </div>
                                    </div><!-- .nk-reply-item -->
                                </div>
                                <div class="nk-ibx-reply-form nk-reply-form">
                                    <div class="nk-reply-form-header">
                                        <div class="nk-reply-form-group">
                                            <div class="nk-reply-form-dropdown">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-trigger btn-icon" data-toggle="dropdown" href="#"><em class="icon ni ni-curve-up-left"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-md">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a class="dropdown-item" href="#"><em class="icon ni ni-reply-fill"></em> <span>Reply to Abu Bin Ishtiyak</span></a></li>
                                                            <li><a class="dropdown-item" href="#"><em class="icon ni ni-forward-arrow-fill"></em> <span>Forword</span></a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#"><em class="icon ni ni-edit-fill"></em> <span>Edit Subject</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nk-reply-form-title d-sm-none">Reply</div>
                                            <div class="nk-reply-form-input-group">
                                                <div class="nk-reply-form-input nk-reply-form-input-to">
                                                    <label class="label">To</label>
                                                    <input type="text" value="info@softnio.com" class="input-mail tagify" placeholder="" data-whitelist="team@softnio.com, help@softnio.com, contact@softnio.com">
                                                </div>
                                                <div class="nk-reply-form-input nk-reply-form-input-cc" data-content="mail-cc">
                                                    <label class="label">Cc</label>
                                                    <input type="text" class="input-mail tagify">
                                                    <a href="#" class="toggle-opt" data-target="mail-cc"><em class="icon ni ni-cross"></em></a>
                                                </div>
                                                <div class="nk-reply-form-input nk-reply-form-input-bcc" data-content="mail-bcc">
                                                    <label class="label">Bcc</label>
                                                    <input type="text" class="input-mail tagify">
                                                    <a href="#" class="toggle-opt" data-target="mail-bcc"><em class="icon ni ni-cross"></em></a>
                                                </div>
                                            </div>
                                            <ul class="nk-reply-form-nav">
                                                <li><a tabindex="-1" class="toggle-opt" data-target="mail-cc" href="#">CC</a></li>
                                                <li><a tabindex="-1" class="toggle-opt" data-target="mail-bcc" href="#">BCC</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="nk-reply-form-editor">
                                        <div class="nk-reply-form-field">
                                            <textarea class="form-control form-control-simple no-resize" placeholder="Hello"></textarea>
                                        </div>
                                    </div><!-- .nk-reply-form-editor -->
                                    <div class="nk-reply-form-tools">
                                        <ul class="nk-reply-form-actions g-1">
                                            <li class="mr-2"><button class="btn btn-primary" type="submit">Send</button></li>
                                            <li>
                                                <div class="dropdown">
                                                    <a class="btn btn-icon btn-sm btn-tooltip" data-toggle="dropdown" title="Templates" href="#"><em class="icon ni ni-hash"></em></a>
                                                    <div class="dropdown-menu">
                                                        <ul class="link-list-opt no-bdr link-list-template">
                                                            <li class="opt-head"><span>Quick Insert</span></li>
                                                            <li><a href="#"><span>Thank you message</span></a></li>
                                                            <li><a href="#"><span>Your issues solved</span></a></li>
                                                            <li><a href="#"><span>Thank you message</span></a></li>
                                                            <li class="divider">
                                                            <li><a href="#"><em class="icon ni ni-file-plus"></em><span>Save as Template</span></a></li>
                                                            <li><a href="#"><em class="icon ni ni-notes-alt"></em><span>Manage Template</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="btn btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="Upload Attachment" href="#"><em class="icon ni ni-clip-v"></em></a>
                                            </li>
                                            <li>
                                                <a class="btn btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="Upload Images" href="#"><em class="icon ni ni-img"></em></a>
                                            </li>
                                        </ul>
                                        <ul class="nk-reply-form-actions g-1">
                                            <li>
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle btn-trigger btn btn-icon" data-toggle="dropdown"><em class="icon ni ni-more-v"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><span>Another Option</span></a></li>
                                                            <li><a href="#"><span>More Option</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="#" class="btn-trigger btn btn-icon mr-n2"><em class="icon ni ni-trash"></em></a>
                                            </li>
                                        </ul>
                                    </div><!-- .nk-reply-form-tools -->
                                </div><!-- .nk-reply-form -->
                            </div><!-- .nk-reply -->
                        </div>
                    </div><!-- .nk-ibx-body -->
                </div><!-- .nk-ibx -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->
<!-- app-root @e -->
<!-- @@ Compose Mail Modal @e -->
<div class="modal fade" tabindex="-1" role="dialog" id="compose-mail">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Compose Message</h6>
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            </div>
            <div class="modal-body p-0">
                <div class="nk-reply-form-header">
                    <div class="nk-reply-form-group">
                        <div class="nk-reply-form-input-group">
                            <div class="nk-reply-form-input nk-reply-form-input-to">
                                <label class="label">To</label>
                                <input type="text" class="input-mail tagify" placeholder="Recipient" data-whitelist="team@softnio.com, help@softnio.com, contact@softnio.com">
                            </div>
                            <div class="nk-reply-form-input nk-reply-form-input-cc" data-content="mail-cc">
                                <label class="label">Cc</label>
                                <input type="text" class="input-mail tagify">
                                <a href="#" class="toggle-opt" data-target="mail-cc"><em class="icon ni ni-cross"></em></a>
                            </div>
                            <div class="nk-reply-form-input nk-reply-form-input-bcc" data-content="mail-bcc">
                                <label class="label">Bcc</label>
                                <input type="text" class="input-mail tagify">
                                <a href="#" class="toggle-opt" data-target="mail-bcc"><em class="icon ni ni-cross"></em></a>
                            </div>
                        </div>
                        <ul class="nk-reply-form-nav">
                            <li><a tabindex="-1" class="toggle-opt" data-target="mail-cc" href="#">CC</a></li>
                            <li><a tabindex="-1" class="toggle-opt" data-target="mail-bcc" href="#">BCC</a></li>
                        </ul>
                    </div>
                </div>
                <div class="nk-reply-form-editor">
                    <div class="nk-reply-form-field">
                        <input type="text" class="form-control form-control-simple" placeholder="Subject">
                    </div>
                    <div class="nk-reply-form-field">
                        <textarea class="form-control form-control-simple no-resize ex-large" placeholder="Hello"></textarea>
                    </div>
                </div><!-- .nk-reply-form-editor -->
                <div class="nk-reply-form-tools">
                    <ul class="nk-reply-form-actions g-1">
                        <li class="mr-2"><button class="btn btn-primary" type="submit">Send</button></li>
                        <li>
                            <div class="dropdown">
                                <a class="btn btn-icon btn-sm btn-tooltip" data-toggle="dropdown" title="Templates" href="#"><em class="icon ni ni-hash"></em></a>
                                <div class="dropdown-menu">
                                    <ul class="link-list-opt no-bdr link-list-template">
                                        <li class="opt-head"><span>Quick Insert</span></li>
                                        <li><a href="#"><span>Thank you message</span></a></li>
                                        <li><a href="#"><span>Your issues solved</span></a></li>
                                        <li><a href="#"><span>Thank you message</span></a></li>
                                        <li class="divider">
                                        <li><a href="#"><em class="icon ni ni-file-plus"></em><span>Save as Template</span></a></li>
                                        <li><a href="#"><em class="icon ni ni-notes-alt"></em><span>Manage Template</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="btn btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="Upload Attachment" href="#"><em class="icon ni ni-clip-v"></em></a>
                        </li>
                        <li class="d-none d-sm-block">
                            <a class="btn btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="Insert Emoji" href="#"><em class="icon ni ni-happy"></em></a>
                        </li>
                        <li class="d-none d-sm-block">
                            <a class="btn btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="Upload Images" href="#"><em class="icon ni ni-img"></em></a>
                        </li>
                    </ul>
                    <ul class="nk-reply-form-actions g-1">
                        <li>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle btn-trigger btn btn-icon" data-toggle="dropdown"><em class="icon ni ni-more-v"></em></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="link-list-opt no-bdr">
                                        <li><a href="#"><span>Another Option</span></a></li>
                                        <li><a href="#"><span>More Option</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="btn-trigger btn btn-icon mr-n2"><em class="icon ni ni-trash"></em></a>
                        </li>
                    </ul>
                </div><!-- .nk-reply-form-tools -->
            </div><!-- .modal-body -->
        </div><!-- .modal-content -->
    </div><!-- .modla-dialog -->
</div><!-- .modal -->
<!-- JavaScript -->