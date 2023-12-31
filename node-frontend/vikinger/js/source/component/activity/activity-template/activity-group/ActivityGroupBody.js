import React from 'react';

import Avatar from '../../../avatar/Avatar';

import TagSticker from '../../../tag/TagSticker';

import UserStatusTypeList from '../../../user-status/user-status-type/UserStatusTypeList';

function ActivityGroupBody(props) {
  const memberCountText = props.data.group.total_member_count === 1 ? vikinger_translation.member : vikinger_translation.members;

  const groupTypes = props.data.group.group_types.length > 0 ? props.data.group.group_types.filter((groupType => {
    const groupTypeSettings = vikinger_constants.settings.group_types[groupType];

    return groupTypeSettings && groupTypeSettings.show_in_list === '1';
  })) : false;

  return (
    <div className="widget-box-status-content">
      {/* USER PREVIEW WIDGET */}
      <div className="user-preview-widget">
        <a href={props.data.group.link}>
          <div className="user-preview-widget-cover" style={{background: `url('${props.data.group.cover_image_url}') center center / cover no-repeat`}}></div>
        </a>

        <TagSticker icon={props.data.group.status} />

        <div className="user-short-description small">
          <Avatar modifiers="user-short-description-avatar"
                  data={props.data.group}
          />
    
          <p className="user-short-description-title"><a href={props.data.group.link}>{props.data.group.name}</a></p>
        {
          groupTypes &&
            <UserStatusTypeList tags={groupTypes} />
        }
        </div>

        {/* USER PREVIEW WIDGET FOOTER */}
        <div className="user-preview-widget-footer">
          {/* USER PREVIEW WIDGET FOOTER ACTION */}
          <div className="user-preview-widget-footer-action"></div>
          {/* USER PREVIEW WIDGET FOOTER ACTION */}

          {/* USER STATS */}
          <div className="user-stats">
            <div className="user-stat">
              <p className="user-stat-title">{props.data.group.total_member_count}</p>
              <p className="user-stat-text">{memberCountText}</p>
            </div>
          </div>
          {/* USER STATS */}
        </div>
        {/* USER PREVIEW WIDGET FOOTER */}
      </div>
      {/* USER PREVIEW WIDGET */}
    </div>
  );
}

export { ActivityGroupBody as default };