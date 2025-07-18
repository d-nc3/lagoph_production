<div class="d-flex align-items-center ms-3 ms-lg-4">
	<a href="javascript:void(0);" class="btn btn-icon btn-custom btn-color-gray-700 btn-active-color-primary btn-outline btn-outline-secondary btn-active-bg-light position-relative" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
		<!--begin::Svg Icon | path: icons/duotune/general/gen007.svg-->
		<span class="svg-icon svg-icon-1 svg-icon-white">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				<path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="black" />
				<path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="black" />
			</svg>
		</span>
		<!--end::Svg Icon-->
		<?php if (isset($page_data['unread_count']) && $page_data['unread_count']): ?>
			<span class="bullet bullet-dot bg-primary h-6px w-6px position-absolute translate-middle top-0 start-100 animation-blink"></span>
		<?php endif; ?>
	</a>
	<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
		<div class="d-flex flex-column bgi-no-repeat rounded-top" style="background-image:url(<?= base_url('resources/dist/assets/media/misc/pattern-1.jpg') ?>)">
			<h3 class="text-white fw-bold px-9 mt-10 mb-6">Notifications
				<span class="fs-8 opacity-75 ps-3"><?= $page_data['unread_count'] ?> unread</span>
			</h3>
		</div>
		<!--begin::Items-->
		<div class="scroll-y mh-325px my-5 px-8">
			<?php if (isset($page_data['notifications']) && !empty($page_data['notifications'])): ?>
				<?php foreach ($page_data['notifications'] as $key => $value): ?>
					<div class="d-flex flex-stack py-4">
						<div class="d-flex align-items-center">
							<div class="symbol symbol-35px me-4">
								<button class="btn btn-icon btn-color-gray-500 w-auto px-0 btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
									<span class="svg-icon svg-icon-1 me-n1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="black"></rect>
											<rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="black"></rect>
											<rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="black"></rect>
											<rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="black"></rect>
										</svg>
									</span>
								</button>
								<div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_61484d2909041" style="">
									<div class="px-7 py-5">
										<div class="menu-item px-2">
											<?php
											$is_read = isset($value['is_read']) && $value['is_read'] ? TRUE : FALSE;
											?>
											<a href="javascript:void(0);" data-kt-element-button="kt_mark_unread_btn" class="menu-link px-5 <?= ($is_read) ? null : 'd-none' ?>" data-id="<?= $value['id'] ?>">Mark as Unread</a>
											<a href="javascript:void(0);" data-kt-element-button="kt_mark_read_btn" class="menu-link px-5 <?= !($is_read) ? null : 'd-none' ?>" data-id="<?= $value['id'] ?>">Mark as Read</a>
										</div>
									</div>
								</div>
							</div>
							<div class="mb-0 me-1">
								<?php
								$is_read = isset($value['is_read']) && $value['is_read'] ? TRUE : FALSE;
								?>
								<a href="<?= isset($value['link']) && $value['link'] ? site_url($value['link']) : 'javascript:void(0);' ?>" data-kt-element-button="kt_notif_link_btn" class="fs-7 <?= ($is_read) ? 'text-gray-800 text-hover-primary' : 'text-primary' ?> fw-bolder"><?= $value['title'] ?></a>
								<div class="text-gray-400 fs-9"><?= $value['message'] ?></div>
							</div>
						</div>
						<span class="badge badge-light fs-12"><?= get_time_ago($value['created_at']) ?></span>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="d-flex flex-stack py-4">
					<div class="d-flex align-items-center text-center">
						<span class="fs-6 text-gray-800 fw-bolder">No data available</span>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<!--end::Items-->
		<div class="d-flex flex-column px-9">
			<div class="py-3 text-center border-top">
				<a href="<?= site_url('Profile/notifications/' . $this->session->userdata('user_info')['id']) ?>" class="btn btn-color-gray-600 btn-active-color-primary">View All Notifications
					<span class="svg-icon svg-icon-5">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
							<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
						</svg>
					</span>
				</a>
			</div>
		</div>
	</div>
</div>