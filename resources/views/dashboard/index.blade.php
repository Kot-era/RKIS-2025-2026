@extends('layouts.app')
@section('title', 'Главная')
@section('content')
<?php
$u=auth()->user();$isSt=$u->role==='student';$isTe=$u->role==='teacher';$isAd=$u->role==='admin';
$dow=(int)date('N');
$cols=['#6366f1','#8b5cf6','#ec4899','#f43f5e','#f97316','#10b981','#06b6d4','#3b82f6'];
$bg=$cols[abs(crc32($u->login))%count($cols)];
$ini=mb_strtoupper(mb_substr($u->last_name,0,1).mb_substr($u->first_name,0,1));
if($isSt){
$tl=\App\Models\Schedule::where('day_of_week',$dow)->where('group_name',$u->group_name)->orderBy('lesson_number')->get();
$tc=$tl->count();$wc=\App\Models\Schedule::where('group_name',$u->group_name)->count();
$ac=\App\Models\Attendance::where('user_id',$u->id)->where('status','present')->count();
$tot=\App\Models\Attendance::where('user_id',$u->id)->count();$pct=$tot>0?round($ac/$tot*100):0;
}elseif($isTe){
$tl=\App\Models\Schedule::where('day_of_week',$dow)->where('teacher_id',$u->id)->orderBy('lesson_number')->get();
$tc=$tl->count();$sc=\App\Models\Schedule::where('teacher_id',$u->id)->distinct()->count('subject');
$gc=\App\Models\Schedule::where('teacher_id',$u->id)->distinct()->count('group_name');
}else{$tl=collect();$tc=0;}
try{$news=\App\Models\News::orderBy('created_at','desc')->limit(4)->get();}catch(\Exception $e){$news=collect();}
$slots=[1=>['08:00','09:30'],2=>['09:40','11:10'],3=>['11:40','13:10'],4=>['13:20','14:50'],5=>['15:00','16:30'],6=>['16:40','18:10']];
$dF=['','&#1055;&#1086;&#1085;&#1077;&#1076;&#1077;&#1083;&#1100;&#1085;&#1080;&#1082;','&#1042;&#1090;&#1086;&#1088;&#1085;&#1080;&#1082;','&#1057;&#1088;&#1077;&#1076;&#1072;','&#1063;&#1077;&#1090;&#1074;&#1077;&#1088;&#1075;','&#1055;&#1103;&#1090;&#1085;&#1080;&#1094;&#1072;','&#1057;&#1091;&#1073;&#1073;&#1086;&#1090;&#1072;','&#1042;&#1086;&#1089;&#1082;&#1088;&#1077;&#1089;&#1077;&#1085;&#1100;&#1077;'];
$sc2=['#6366f1','#8b5cf6','#ec4899','#f43f5e','#f97316','#10b981','#06b6d4','#3b82f6'];
?>
<style>
.dw{max-width:1100px;margin:0 auto;padding:24px 16px;display:flex;flex-direction:column;gap:28px}
.hero{background:linear-gradient(135deg,rgba(99,102,241,.15),rgba(139,92,246,.15));border:1px solid rgba(99,102,241,.25);border-radius:24px;padding:32px;display:flex;align-items:center;gap:24px;position:relative;overflow:hidden;backdrop-filter:blur(12px)}
.hero::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(99,102,241,.07),transparent 60%);pointer-events:none}
.hblob{position:absolute;border-radius:50%;filter:blur(60px);opacity:.35;pointer-events:none}
.hb1{width:220px;height:220px;background:var(--accent);top:-70px;right:-50px;animation:blobPulse 6s ease-in-out infinite}
.hb2{width:150px;height:150px;background:var(--accent2);bottom:-40px;right:150px;animation:blobPulse 8s ease-in-out infinite reverse}
@keyframes blobPulse{0%,100%{transform:scale(1)}50%{transform:scale(1.12)}}
.ava{width:80px;height:80px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:28px;font-weight:800;color:#fff;flex-shrink:0;box-shadow:0 8px 28px rgba(0,0,0,.25);border:3px solid rgba(255,255,255,.2);z-index:1}
.hi{flex:1;z-index:1;min-width:0}
.hn{font-size:1.55rem;font-weight:700;color:var(--text);line-height:1.2;margin-bottom:6px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.hr{display:inline-flex;align-items:center;gap:6px;background:rgba(99,102,241,.18);color:var(--accent);border:1px solid rgba(99,102,241,.3);border-radius:20px;padding:4px 12px;font-size:.8rem;font-weight:600;margin-bottom:10px}
.hr svg{width:14px;height:14px}
.hm{display:flex;flex-wrap:wrap;gap:12px}
.hmi{display:flex;align-items:center;gap:5px;font-size:.83rem;color:var(--muted)}
.hmi svg{width:14px;height:14px;opacity:.7}
.hck{text-align:right;z-index:1;flex-shrink:0}
.hct{font-size:2rem;font-weight:800;color:var(--text);line-height:1;font-variant-numeric:tabular-nums}
.hcd{font-size:.82rem;color:var(--muted);margin-top:4px}
.cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:16px}
.card{background:rgba(255,255,255,.04);border:1px solid var(--border);border-radius:20px;padding:22px;display:flex;flex-direction:column;gap:8px;transition:transform .2s,box-shadow .2s}
.card:hover{transform:translateY(-3px);box-shadow:0 12px 36px rgba(0,0,0,.15)}
.ctop{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:4px}
.ci{width:44px;height:44px;border-radius:14px;display:flex;align-items:center;justify-content:center}
.ci svg{width:22px;height:22px}
.ct2{font-size:.74rem;padding:3px 8px;border-radius:10px;font-weight:600}
.cv{font-size:2.4rem;font-weight:800;color:var(--text);line-height:1}
.cl{font-size:.82rem;color:var(--muted);font-weight:500}
.shd{display:flex;align-items:center;gap:10px;margin-bottom:16px}
.shd svg{width:20px;height:20px;color:var(--accent)}
.sht{font-size:1.1rem;font-weight:700;color:var(--text)}
.shb{margin-left:auto;background:rgba(99,102,241,.15);color:var(--accent);border-radius:10px;padding:3px 10px;font-size:.78rem;font-weight:600}
.sbox{background:rgba(255,255,255,.03);border:1px solid var(--border);border-radius:20px;overflow:hidden}
.semp{padding:40px;text-align:center;color:var(--muted)}
.semp svg{width:44px;height:44px;opacity:.25;margin:0 auto 12px;display:block}
.si{display:flex;align-items:stretch;border-bottom:1px solid var(--border);transition:background .15s}
.si:last-child{border-bottom:none}
.si:hover{background:rgba(255,255,255,.04)}
.stm{padding:16px 18px;min-width:96px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:2px;border-right:1px solid var(--border)}
.stn{font-size:.68rem;color:var(--muted);font-weight:700;text-transform:uppercase;letter-spacing:.04em}
.sts{font-size:.9rem;font-weight:700;color:var(--text)}
.ste{font-size:.76rem;color:var(--muted)}
.sb2{flex:1;padding:14px 18px;display:flex;flex-direction:column;gap:5px;justify-content:center}
.sbs{font-size:1rem;font-weight:600;color:var(--text);display:flex;align-items:center;gap:8px}
.sbm{display:flex;flex-wrap:wrap;gap:10px;margin-top:3px}
.stg{display:inline-flex;align-items:center;gap:4px;font-size:.77rem;color:var(--muted)}
.stg svg{width:12px;height:12px;opacity:.6}
.sdot{width:8px;height:8px;border-radius:50%;flex-shrink:0;display:inline-block}
.sr2{padding:14px 18px;display:flex;align-items:center}
.srm{background:rgba(99,102,241,.12);color:var(--accent);border-radius:10px;padding:6px 12px;font-size:.82rem;font-weight:600;white-space:nowrap}
.ng{display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:16px}
.nc{background:rgba(255,255,255,.04);border:1px solid var(--border);border-radius:18px;overflow:hidden;transition:transform .2s,box-shadow .2s;text-decoration:none;display:block;color:inherit}
.nc:hover{transform:translateY(-4px);box-shadow:0 16px 48px rgba(0,0,0,.18)}
.nci{height:120px;background:linear-gradient(135deg,rgba(99,102,241,.18),rgba(139,92,246,.18));display:flex;align-items:center;justify-content:center}
.nci svg{width:38px;height:38px;opacity:.35}
.ncb{padding:14px 16px}
.ncc{font-size:.7rem;font-weight:700;color:var(--accent);text-transform:uppercase;letter-spacing:.06em;margin-bottom:5px}
.nct{font-size:.93rem;font-weight:600;color:var(--text);line-height:1.4;margin-bottom:6px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.ncd{font-size:.74rem;color:var(--muted)}
.qg{display:grid;grid-template-columns:repeat(auto-fill,minmax(150px,1fr));gap:12px}
.qa{display:flex;flex-direction:column;align-items:center;gap:10px;background:rgba(255,255,255,.04);border:1px solid var(--border);border-radius:18px;padding:20px 14px;text-decoration:none;transition:all .2s;color:var(--text)}
.qa:hover{transform:translateY(-3px);box-shadow:0 10px 30px rgba(0,0,0,.14);background:rgba(99,102,241,.08);border-color:rgba(99,102,241,.4)}
.qai{width:46px;height:46px;border-radius:14px;display:flex;align-items:center;justify-content:center}
.qai svg{width:22px;height:22px}
.qal{font-size:.82rem;font-weight:600;text-align:center;line-height:1.3}
@media(max-width:640px){.hero{flex-direction:column;text-align:center;padding:22px 18px}.hm{justify-content:center}.hck{display:none}.ava{width:70px;height:70px;font-size:24px}.hn{font-size:1.25rem}.cards{grid-template-columns:1fr 1fr}.stm{min-width:76px;padding:10px}.sr2{display:none}.qg{grid-template-columns:repeat(3,1fr)}}
</style>
<div class="dw">
<div class="hero"><div class="hblob hb1"></div><div class="hblob hb2"></div>
<div class="ava" style="background:<?=$bg?>"><?=$ini?></div>
<div class="hi">
<div class="hn"><?=htmlspecialchars($u->last_name.' '.$u->first_name.($u->patronymic?' '.$u->patronymic:''))?></div>
<div class="hr">
<?php if($isSt):?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3L2 9l10 6 10-6-10-6z"/><path d="M2 17l10 6 10-6"/></svg>&#1057;&#1090;&#1091;&#1076;&#1077;&#1085;&#1090;
<?php elseif($isTe):?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8m-4-4v4"/></svg>&#1055;&#1088;&#1077;&#1087;&#1086;&#1076;&#1072;&#1074;&#1072;&#1090;&#1077;&#1083;&#1100;
<?php else:?><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>&#1040;&#1076;&#1084;&#1080;&#1085;&#1080;&#1089;&#1090;&#1088;&#1072;&#1090;&#1086;&#1088;
<?php endif;?></div>
<div class="hm">
<?php if($u->group_name):?><div class="hmi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg><?=htmlspecialchars($u->group_name)?></div><?php endif;?>
<?php if(!empty($u->specialty_name)):?><div class="hmi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg><?=htmlspecialchars($u->specialty_name)?></div><?php endif;?>
</div></div>
<div class="hck"><div class="hct"><?=date('H:i')?></div><div class="hcd"><?=$dF[$dow]?>, <?=date('d.m.Y')?></div></div>
</div>
<div class="cards">
<?php if($isSt):?>
<div class="card"><div class="ctop"><div class="ci" style="background:rgba(99,102,241,.15)"><svg viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div></div><div class="cv"><?=$tc?></div><div class="cl">&#1047;&#1072;&#1085;&#1103;&#1090;&#1080;&#1081; &#1089;&#1077;&#1075;&#1086;&#1076;&#1085;&#1103;</div></div>
<div class="card"><div class="ctop"><div class="ci" style="background:rgba(139,92,246,.15)"><svg viewBox="0 0 24 24" fill="none" stroke="#8b5cf6" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg></div></div><div class="cv"><?=$wc?></div><div class="cl">&#1042; &#1085;&#1077;&#1076;&#1077;&#1083;&#1102;</div></div>
<div class="card"><div class="ctop"><div class="ci" style="background:rgba(16,185,129,.15)"><svg viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg></div><div class="ct2" style="background:rgba(16,185,129,.15);color:#10b981"><?=$pct?>%</div></div><div class="cv"><?=$ac?></div><div class="cl">&#1055;&#1086;&#1089;&#1077;&#1097;&#1077;&#1085;&#1080;&#1081;</div></div>
<div class="card"><div class="ctop"><div class="ci" style="background:rgba(6,182,212,.15)"><svg viewBox="0 0 24 24" fill="none" stroke="#06b6d4" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg></div></div><div class="cv"><?=$u->course??1?></div><div class="cl">&#1050;&#1091;&#1088;&#1089;</div></div>
<?php elseif($isTe):?>
<div class="card"><div class="ctop"><div class="ci" style="background:rgba(99,102,241,.15)"><svg viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div></div><div class="cv"><?=$tc?></div><div class="cl">&#1047;&#1072;&#1085;&#1103;&#1090;&#1080;&#1081; &#1089;&#1077;&#1075;&#1086;&#1076;&#1085;&#1103;</div></div>
<div class="card"><div class="ctop"><div class="ci" style="background:rgba(139,92,246,.15)"><svg viewBox="0 0 24 24" fill="none" stroke="#8b5cf6" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></div></div><div class="cv"><?=$sc?></div><div class="cl">&#1044;&#1080;&#1089;&#1094;&#1080;&#1087;&#1083;&#1080;&#1085;</div></div>
<div class="card"><div class="ctop"><div class="ci" style="background:rgba(236,72,153,.15)"><svg viewBox="0 0 24 24" fill="none" stroke="#ec4899" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg></div></div><div class="cv"><?=$gc?></div><div class="cl">&#1043;&#1088;&#1091;&#1087;&#1087;</div></div>
<?php else:?>
<div class="card"><div class="ctop"><div class="ci" style="background:rgba(99,102,241,.15)"><svg viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div></div><div class="cv"><?=\App\Models\User::count()?></div><div class="cl">&#1055;&#1086;&#1083;&#1100;&#1079;&#1086;&#1074;&#1072;&#1090;&#1077;&#1083;&#1077;&#1081;</div></div>
<?php endif;?>
</div>
<div>
<div class="shd"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg><div class="sht">&#1056;&#1072;&#1089;&#1087;&#1080;&#1089;&#1072;&#1085;&#1080;&#1077; &mdash; <?=$dF[$dow]?></div><div class="shb"><?=$tc?> &#1079;&#1072;&#1085;.</div></div>
<div class="sbox">
<?php if($tl->isEmpty()):?>
<div class="semp"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg><div>&#1047;&#1072;&#1085;&#1103;&#1090;&#1080;&#1081; &#1089;&#1077;&#1075;&#1086;&#1076;&#1085;&#1103; &#1085;&#1077;&#1090;</div></div>
<?php else:?>
<?php foreach($tl as $i=>$l):$sl=$slots[$l->lesson_number]??[$l->time_start,$l->time_end];$dc=$sc2[$i%count($sc2)];?>
<div class="si">
<div class="stm"><div class="stn">&#8470;<?=$l->lesson_number?></div><div class="sts"><?=$sl[0]?></div><div class="ste"><?=$sl[1]?></div></div>
<div class="sb2"><div class="sbs"><span class="sdot" style="background:<?=$dc?>"></span><?=htmlspecialchars($l->subject)?></div>
<div class="sbm"><?php if($isTe):?><div class="stg"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg><?=htmlspecialchars($l->group_name)?></div><?php endif;?></div>
</div>
<div class="sr2"><div class="srm">&#1072;&#1091;&#1076;. <?=htmlspecialchars($l->room??'')?></div></div>
</div>
<?php endforeach;?>
<?php endif;?>
</div></div>
<?php if($news->isNotEmpty()):?>
<div><div class="shd"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10l4 4v10a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg><div class="sht">&#1053;&#1086;&#1074;&#1086;&#1089;&#1090;&#1080;</div></div>
<div class="ng"><?php foreach($news as $n):?>
<a href="/news/<?=$n->id?>" class="nc"><div class="nci"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
<div class="ncb"><div class="ncc">&#1053;&#1086;&#1074;&#1086;&#1089;&#1090;&#1100;</div><div class="nct"><?=htmlspecialchars($n->title??'')?></div><div class="ncd"><?=$n->created_at?->format('d.m.Y')??''?></div></div></a>
<?php endforeach;?></div></div>
<?php endif;?>
<div><div class="shd"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg><div class="sht">&#1041;&#1099;&#1089;&#1090;&#1088;&#1099;&#1081; &#1076;&#1086;&#1089;&#1090;&#1091;&#1087;</div></div>
<div class="qg">
<a href="/schedule" class="qa"><div class="qai" style="background:rgba(99,102,241,.15)"><svg viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div><div class="qal">&#1056;&#1072;&#1089;&#1087;&#1080;&#1089;&#1072;&#1085;&#1080;&#1077;</div></a>
<a href="/news" class="qa"><div class="qai" style="background:rgba(236,72,153,.15)"><svg viewBox="0 0 24 24" fill="none" stroke="#ec4899" stroke-width="2"><path d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10l4 4v10a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg></div><div class="qal">&#1053;&#1086;&#1074;&#1086;&#1089;&#1090;&#1080;</div></a>
<a href="/attendance" class="qa"><div class="qai" style="background:rgba(16,185,129,.15)"><svg viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div><div class="qal">&#1055;&#1086;&#1089;&#1077;&#1097;&#1072;&#1077;&#1084;&#1086;&#1089;&#1090;&#1100;</div></a>
<a href="/profile" class="qa"><div class="qai" style="background:rgba(6,182,212,.15)"><svg viewBox="0 0 24 24" fill="none" stroke="#06b6d4" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg></div><div class="qal">&#1055;&#1088;&#1086;&#1092;&#1080;&#1083;&#1100;</div></a>
</div></div>
</div>
@endsection
